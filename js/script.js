const tombolCari = document.querySelector(".tombol-cari");
const keyword = document.querySelector(".keyword");
const tabel = document.querySelector(".tabel");

// console.log(keyword);

// hilangkan tombol cari
tombolCari.style.display = "none";

// event ketika menuliskan keyword
keyword.addEventListener("keyup", function () {
  // console.log(keyword.value);

  fetch("../ajax/ajax_cari.php?keyword=" + keyword.value)
    .then((response) => response.text())
    .then((response) => (tabel.innerHTML = response));
});

