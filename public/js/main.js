// for sidebar js
        document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('allBooksSidebar');
        const overlay = document.getElementById('booksOverlay');
        const openBtn = document.getElementById('openAllBooksBtn');
        const closeBtn = document.getElementById('closeBooksBtn');
        const searchInput = document.getElementById('bookSearchInput');
        const tabBtns = document.querySelectorAll('.sidebar-tab-btn');
        const tabContents = document.querySelectorAll('.sidebar-tab-content');
        const noResults = document.getElementById('noBookResults');

        let lastFocused = null;

        function openSidebar() {
            lastFocused = document.activeElement;
                sidebar.classList.add('active');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
                sidebar.addEventListener('transitionend', () => closeBtn.focus(), { once: true });
            }

        function closeSidebar() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
            if (lastFocused) lastFocused.focus();
        }

        openBtn?.addEventListener('click', function (e) {
            e.preventDefault();
            openSidebar();
        });

        closeBtn.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', closeSidebar);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && sidebar.classList.contains('active')) closeSidebar();
        });

        tabBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                tabBtns.forEach(b => { b.classList.remove('active'); b.setAttribute('aria-selected', 'false'); });
                tabContents.forEach(c => c.classList.remove('active'));

                this.classList.add('active');
                this.setAttribute('aria-selected', 'true');
                document.getElementById(this.dataset.tab + 'Tab').classList.add('active');
            });
        });

        let debounceTimer;
        searchInput.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => filterBooks(this.value), 150);
        });

        function filterBooks(value) {
            const term = value.toLowerCase().trim();
            let visibleCount = 0;

            document.querySelectorAll('.sidebar-book-item').forEach(item => {
                const name = item.dataset.name.toLowerCase();
                const author = item.dataset.author.toLowerCase();
                const match = name.includes(term) || author.includes(term);
                item.style.display = match ? 'flex' : 'none';
                if (match) visibleCount++;
            });

            if (noResults) noResults.style.display = visibleCount === 0 ? 'block' : 'none';
        }
        document.querySelectorAll('.sidebar-book-item').forEach(item => {
            item.addEventListener('click', function (e) {
                e.preventDefault();
                closeSidebar();
                window.openBookModal({
                    image: this.dataset.image,
                    name: this.dataset.name,
                    author: this.dataset.author,
                    description: this.dataset.description,
                    pdf: this.dataset.pdf
                });
            });
        });
    });

// for show book js
    document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('bookModal');
    const modalOverlay = document.getElementById('bookModalOverlay');
    const closeModalBtn = document.getElementById('closeBookModal');

    const modalImage = document.getElementById('modalBookImage');
    const modalName = document.getElementById('modalBookName');
    const modalAuthor = document.getElementById('modalBookAuthor');
    const modalDescription = document.getElementById('modalBookDescription');
    const modalReadBtn = document.getElementById('modalReadBtn');
    const modalLoginBtn = document.getElementById('modalLoginBtn');

    const isLoggedIn = document.body.dataset.loggedIn === 'true';

    function openModal(data) {
        modalImage.src = data.image;
        modalImage.alt = data.name;
        modalName.textContent = data.name;
        modalAuthor.textContent = data.author;
        modalDescription.textContent = data.description;

        const hasPdf = !!data.pdf;

        if (isLoggedIn && hasPdf) {
            modalReadBtn.href = data.pdf;
            modalReadBtn.style.display = 'inline-block';
            modalLoginBtn.style.display = 'none';
        } else if (!isLoggedIn) {
            modalReadBtn.style.display = 'none';
            modalLoginBtn.style.display = 'inline-block';
        } else {
            modalReadBtn.style.display = 'none';
            modalLoginBtn.style.display = 'none';
        }

        document.body.style.overflow = 'hidden';
        modalOverlay.classList.add('active');
        requestAnimationFrame(() => modal.classList.add('active'));
    }

    function closeModal() {
        modal.classList.remove('active');
        modalOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    // expose so other scripts (sidebar) can trigger it
    window.openBookModal = openModal;

    // book-card grid
    document.querySelectorAll('.book-card').forEach(card => {
        card.addEventListener('click', function () {
            openModal({
                image: this.dataset.image,
                name: this.dataset.name,
                author: this.dataset.author,
                description: this.dataset.description,
                pdf: this.dataset.pdf
            });
        });
    });

    document.querySelectorAll('.add-to-cart').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            // your add-to-cart logic here
        });
    });

    closeModalBtn.addEventListener('click', closeModal);
    modalOverlay.addEventListener('click', closeModal);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
    });
});
//  this is the view card user profile in top header
document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('userAccountToggle');
        const overlay = document.getElementById('profileModalOverlay');
        const closeBtn = document.getElementById('profileModalClose');

        function openModal() {
            overlay.classList.add('show');
            document.body.classList.add('modal-open');
            document.body.style.overflow = 'hidden'; // stop scrolling behind modal
        }

        function closeModal() {
            overlay.classList.remove('show');
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
        }

        if (toggle) {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                openModal();
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }

        // close when clicking outside the modal box
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) {
                closeModal();
            }
        });

        // close on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeModal();
        });
    });
    
