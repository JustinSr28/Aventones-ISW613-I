const input = document.getElementById('picture');
const img = document.getElementById('preview');
input.addEventListener('change', (e) => {
    const file = e.target.files?.[0];
    if (!file) { img.classList.add('hidden'); img.removeAttribute('src'); return; }
    img.src = URL.createObjectURL(file);
    img.classList.remove('hidden');
});