// Array of all images/assets to preload
const assetsToPreload = [
    // Add all your image URLs here
    'path/to/image1.jpg',
    'path/to/image2.jpg',
    // Add CSS files
    'nicepage.css',
    'index.css',
    // Add JS files 
    'nicepage.js',
    'jquery-1.9.1.min.js'
];

// Preloader function
function preloadAssets() {
    const preloadPromises = assetsToPreload.map(asset => {
        if (asset.match(/\.(jpg|jpeg|png|gif|webp)$/i)) {
            // Image preloading
            return new Promise((resolve, reject) => {
                const img = new Image();
                img.src = asset;
                img.onload = resolve;
                img.onerror = reject;
            });
        } else if (asset.match(/\.css$/i)) {
            // CSS preloading
            return new Promise((resolve, reject) => {
                const link = document.createElement('link');
                link.rel = 'preload';
                link.as = 'style';
                link.href = asset;
                link.onload = resolve;
                link.onerror = reject;
                document.head.appendChild(link);
            });
        } else if (asset.match(/\.js$/i)) {
            // JavaScript preloading
            return new Promise((resolve, reject) => {
                const script = document.createElement('link');
                script.rel = 'preload';
                script.as = 'script';
                script.href = asset;
                script.onload = resolve;
                script.onerror = reject;
                document.head.appendChild(script);
            });
        }
    });

    return Promise.all(preloadPromises);
}