/**
 * Fungsi untuk mengambil konten HTML dari file dan memasukkannya ke dalam elemen
 * @param {string} url - Path ke file .html yang akan dimuat
 * @param {string} containerId - ID elemen div tempat konten akan ditempatkan
 */
async function loadSection(url, containerId) {
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status} for ${url}`);
        }
        const html = await response.text();
        document.getElementById(containerId).innerHTML = html;
    } catch (error) {
        console.error(`Tidak dapat memuat bagian dari ${url}:`, error);
        document.getElementById(containerId).innerHTML = 
            `<p class="text-center text-red-500">Error: Gagal memuat konten dari ${url}.</p>`;
    }
}

/**
 * Fungsi untuk menginisialisasi skrip menu mobile.
 * HARUS dijalankan SETELAH header dimuat.
 */
function initializeMobileMenu() {
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Menutup menu saat link di-klik (hanya untuk link #)
        const mobileMenuLinks = mobileMenu.querySelectorAll('a[href^="#"]');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
    } else {
        console.error("Elemen menu mobile tidak ditemukan.");
    }
}

// Saat halaman selesai dimuat, jalankan pemuat
document.addEventListener('DOMContentLoaded', async () => {
    
    // Cek apakah kita di Halaman Utama (index.html) atau di Halaman Produk (dalam folder /pages/)
    const onHomePage = document.getElementById('hero-container');
    const onProductPage = window.location.pathname.includes('/pages/');

    // 1. Muat Header (selalu dimuat)
    // Menentukan path yang benar ke folder src/
    const headerPath = onProductPage ? '../src/_header.html' : 'src/_header.html';
    await loadSection(headerPath, 'header-container');
    
    // 2. Inisialisasi Menu
    initializeMobileMenu();
    
    // 3. Muat bagian-bagian berdasarkan halaman
    let sectionPromises = [];

    // Jika kita di Halaman Utama (index.html)
    if (onHomePage) {
        sectionPromises = [
           
            loadSection('src/_about.html', 'about-container'),
            loadSection('src/_testimonials.html', 'testimonials-container'),
            
            loadSection('src/_gallery.html', 'gallery-container')
        ];
    }
    // Jika kita di Halaman Produk (pages/produk.html)
    else if (onProductPage) {
        sectionPromises = [
            // Memuat _products.html dari dalam folder 'pages/' (sesuai screenshot Anda)
            loadSection('_products.html', 'products-container'), 
            loadSection('src/_about.html', 'about-container'),
           
        ];
    }

    // Muat semua bagian yang relevan
    Promise.all(sectionPromises);

    // 4. Muat Footer (selalu dimuat)
    // Menentukan path yang benar ke folder src/
    const footerPath = onProductPage ? '../src/_footer.html' : 'src/_footer.html';
    loadSection(footerPath, 'footer-container');
});

