const tombolCari = document.querySelector(".tombol-cari");
const keyword = document.querySelector(".keyword");
const tabel = document.querySelector(".tabel");

// hilangkan tombol cari
tombolCari.style.display = "none";

// event ketika menuliskan keyword
keyword.addEventListener("keyup", function () {
  fetch("../ajax/ajax_cari_transJual.php?keyword=" + keyword.value)
    .then((response) => response.text())
    .then((response) => (tabel.innerHTML = response));
});


// detail transaksi
// const detail = document.querySelector(".detail");
// console.log(detail);
// detail.addEventListener("on-click", function(){
//   console.log('ok!');
// })