document.getElementById("registerForm").addEventListener("submit", function(e) {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const mobile = document.getElementById("mobile").value;
    const password = document.getElementById("password").value;
    const passwordConfirmation = document.getElementById("password_confirmation").value;

    if (!name || !email || !mobile || !password || password !== passwordConfirmation) {
        alert("Please fill out all fields correctly.");
        e.preventDefault();
    }document.getElementById("registerForm").addEventListener("submit", function(e) {
    // Mengambil nilai dari form
    const name = document.getElementById("registerName").value;
    const email = document.getElementById("registerEmail").value;
    const mobile = document.getElementById("registerMobile").value;
    const password = document.getElementById("registerPassword").value;
    const passwordConfirmation = document.getElementById("registerPasswordConfirmation").value;

    // Validasi form
    if (!name || !email || !mobile || !password || password !== passwordConfirmation) {
        alert("Please fill out all fields correctly.");
        e.preventDefault();  // Mencegah form dikirimkan jika ada kesalahan
    } else {
        // Jika validasi berhasil, lanjutkan ke login (gunakan pengalihan ke halaman login)
        // Anda dapat mengalihkan pengguna setelah data dikirim ke server, jika perlu
        window.location.href = "/login";  // Pengalihan ke halaman login
    }
});

});
