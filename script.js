document.addEventListener("DOMContentLoaded", function() {
  // Mengambil referensi checkbox dan elemen yang akan ditampilkan/sembunyikan
  var toggleCheckbox = document.getElementById("toggleCheckbox");
  var hiddenText = document.getElementById("hiddenText");

  // Menambahkan event listener ke checkbox untuk mendeteksi perubahan
  toggleCheckbox.addEventListener("change", function() {
    // Jika checkbox dicentang (checked), tampilkan elemen, jika tidak, sembunyikan
    if (toggleCheckbox.checked) {
      hiddenText.style.display = "block"; // Tampilkan elemen
    } else {
      hiddenText.style.display = "none"; // Sembunyikan elemen
    }
  });
});