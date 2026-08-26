/* Campus Lost & Found Portal Custom JavaScript */

document.addEventListener('DOMContentLoaded', function () {
    // 1. Loading Overlay Dismissal
    const overlay = document.getElementById('loading-overlay');
    if (overlay) {
        window.addEventListener('load', function () {
            overlay.classList.add('fade-out');
        });
        // Fallback in case load event already fired
        setTimeout(() => {
            overlay.classList.add('fade-out');
        }, 800);
    }

    // 2. Dark/Light Mode Toggler
    const themeToggleBtn = document.getElementById('theme-toggle');
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function () {
            document.body.classList.toggle('dark-mode');
            const isDark = document.body.classList.contains('dark-mode');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            
            // Update icon
            const icon = themeToggleBtn.querySelector('i');
            if (icon) {
                if (isDark) {
                    icon.className = 'fa-solid fa-sun';
                } else {
                    icon.className = 'fa-solid fa-moon';
                }
            }
            
            // Fire event for any subscriber (e.g. Chart.js to redraw charts with custom grid colors)
            document.dispatchEvent(new CustomEvent('themeChanged', { detail: { theme: isDark ? 'dark' : 'light' } }));
        });
    }

    // Apply saved theme early
    const savedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
        document.body.classList.add('dark-mode');
        const icon = themeToggleBtn?.querySelector('i');
        if (icon) icon.className = 'fa-solid fa-sun';
    }

    // 3. Scroll to Top Button
    const scrollTopBtn = document.getElementById('scroll-top');
    if (scrollTopBtn) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 300) {
                scrollTopBtn.classList.add('visible');
            } else {
                scrollTopBtn.classList.remove('visible');
            }
        });
        
        scrollTopBtn.addEventListener('click', function () {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // 4. Custom Toast Notifications
    window.showToast = function (message, type = 'success') {
        let container = document.querySelector('.toast-container-custom');
        if (!container) {
            container = document.createElement('div');
            container.className = 'toast-container-custom';
            document.body.appendChild(container);
        }
        
        const toast = document.createElement('div');
        toast.className = `toast-custom ${type}`;
        
        let iconClass = 'fa-circle-check';
        if (type === 'error') iconClass = 'fa-circle-xmark';
        if (type === 'info') iconClass = 'fa-circle-info';
        
        toast.innerHTML = `
            <i class="fa-solid ${iconClass} toast-icon"></i>
            <div class="toast-content">${message}</div>
            <button class="toast-close"><i class="fa-solid fa-xmark"></i></button>
        `;
        
        container.appendChild(toast);
        
        // Show after appending
        setTimeout(() => toast.classList.add('show'), 50);
        
        // Auto-close
        const autoCloseTimeout = setTimeout(() => {
            closeToast(toast);
        }, 5000);
        
        toast.querySelector('.toast-close').addEventListener('click', () => {
            clearTimeout(autoCloseTimeout);
            closeToast(toast);
        });
    };

    function closeToast(toast) {
        toast.classList.remove('show');
        toast.addEventListener('transitionend', () => {
            toast.remove();
        });
    }

    // 5. Drag & Drop File Upload with Image Previews
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('file-input');
    const previewGrid = document.getElementById('preview-grid');
    
    if (dropzone && fileInput) {
        // Trigger file dialog on click
        dropzone.addEventListener('click', () => fileInput.click());
        
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        // Highlight drop zone
        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, () => dropzone.classList.add('dragover'), false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, () => dropzone.classList.remove('dragover'), false);
        });
        
        // Handle dropped files
        dropzone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        });
        
        // Handle selected files
        fileInput.addEventListener('change', (e) => {
            handleFiles(fileInput.files);
        });
        
        // Hold files list in memory to support actual form submissions
        let filesArray = [];
        
        function handleFiles(files) {
            filesArray = [...filesArray, ...Array.from(files)];
            updateFileInputAndPreviews();
        }
        
        function updateFileInputAndPreviews() {
            // Re-render previews
            if (previewGrid) {
                previewGrid.innerHTML = '';
                filesArray.forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const previewItem = document.createElement('div');
                            previewItem.className = 'upload-preview-item';
                            previewItem.innerHTML = `
                                <img src="${e.target.result}" alt="${file.name}">
                                <button type="button" class="remove-btn" data-index="${index}"><i class="fa-solid fa-xmark"></i></button>
                            `;
                            
                            previewItem.querySelector('.remove-btn').addEventListener('click', (ev) => {
                                ev.stopPropagation();
                                const idx = parseInt(ev.currentTarget.getAttribute('data-index'));
                                filesArray.splice(idx, 1);
                                updateFileInputAndPreviews();
                            });
                            
                            previewGrid.appendChild(previewItem);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
            
            // Note: Since DataTransfer object is needed to assign new files to fileInput programmatic,
            // we will create a new DataTransfer list and update the fileInput files.
            const dataTransfer = new DataTransfer();
            filesArray.forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files;
        }
    }

    // 6. AJAX Live Instant Search & Suggestions
    const searchInput = document.getElementById('ajax-search-input');
    const suggestionsContainer = document.getElementById('search-suggestions');
    const listingsGrid = document.getElementById('listings-grid');
    const filterForm = document.getElementById('filter-form');
    
    if (searchInput) {
        let debounceTimer;
        
        // Listen to input changes for search suggestions
        searchInput.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            const query = searchInput.value.trim();
            
            if (query.length < 2) {
                if (suggestionsContainer) suggestionsContainer.style.display = 'none';
                return;
            }
            
            debounceTimer = setTimeout(() => {
                fetchSuggestions(query);
            }, 300);
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', function (e) {
            if (suggestionsContainer && !searchInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
                suggestionsContainer.style.display = 'none';
            }
        });
        
        // Trigger live search on filter inputs change
        if (filterForm) {
            const inputs = filterForm.querySelectorAll('select, input[type="date"]');
            inputs.forEach(input => {
                input.addEventListener('change', () => {
                    triggerLiveSearch();
                });
            });
            
            // Also trigger search on search text typing (debounced)
            searchInput.addEventListener('input', function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    triggerLiveSearch();
                }, 400);
            });
        }
    }
    
    function fetchSuggestions(query) {
        fetch(`/items/search-ajax?suggest=1&q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                if (suggestionsContainer) {
                    suggestionsContainer.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(item => {
                            const div = document.createElement('div');
                            div.className = 'search-suggestion-item';
                            div.innerHTML = `
                                <span><i class="fa-solid fa-magnifying-glass text-muted me-2"></i><strong>${item.title}</strong> in ${item.category ? item.category.name : 'Unknown'}</span>
                                <span class="badge bg-primary-subtle text-primary">${item.type}</span>
                            `;
                            div.addEventListener('click', () => {
                                searchInput.value = item.title;
                                suggestionsContainer.style.display = 'none';
                                triggerLiveSearch();
                            });
                            suggestionsContainer.appendChild(div);
                        });
                        suggestionsContainer.style.display = 'block';
                    } else {
                        suggestionsContainer.style.display = 'none';
                    }
                }
            })
            .catch(err => console.error('Error fetching suggestions:', err));
    }
    
    function triggerLiveSearch() {
        if (!listingsGrid || !filterForm) return;
        
        // Show skeleton loading in listingsGrid before fetch
        listingsGrid.innerHTML = `
            <div class="col-12 text-center py-5">
                <div class="spinner-premium d-inline-block"></div>
                <p class="text-muted mt-3">Searching listings...</p>
            </div>
        `;
        
        const formData = new FormData(filterForm);
        const searchParams = new URLSearchParams(formData);
        
        fetch(`/items/search-ajax?${searchParams.toString()}`)
            .then(res => res.text())
            .then(html => {
                listingsGrid.innerHTML = html;
                // Reinstate AOS animations for dynamically loaded cards
                if (window.AOS) {
                    window.AOS.refresh();
                }
            })
            .catch(err => {
                console.error('Error fetching search results:', err);
                listingsGrid.innerHTML = '<div class="col-12"><div class="alert alert-danger rounded-4">Failed to fetch search results. Please try again.</div></div>';
            });
    }

    // 7. Custom Delete Confirmation overlay handler
    const deleteForms = document.querySelectorAll('.delete-confirm-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const message = form.getAttribute('data-message') || 'Are you sure you want to delete this listing?';
            
            // We can replace standard window.confirm with a beautiful custom modal logic.
            // For now, let's create a beautiful custom confirmation modal dynamically.
            const confirmModal = document.createElement('div');
            confirmModal.className = 'modal fade';
            confirmModal.id = 'dynamicDeleteConfirmModal';
            confirmModal.tabIndex = -1;
            confirmModal.innerHTML = `
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content glass-card rounded-4 border-0 shadow-lg p-3">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold"><i class="fa-solid fa-triangle-exclamation text-danger me-2"></i>Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-muted">${message}</p>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-premium-outline" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger rounded-pill px-4" id="confirmDeleteBtn">Delete</button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(confirmModal);
            const bsModal = new bootstrap.Modal(confirmModal);
            bsModal.show();
            
            confirmModal.querySelector('#confirmDeleteBtn').addEventListener('click', () => {
                bsModal.hide();
                form.submit();
            });
            
            confirmModal.addEventListener('hidden.bs.modal', () => {
                confirmModal.remove();
            });
        });
    });
});
