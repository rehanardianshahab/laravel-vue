function faktorial(params) {
    hasil = params;
    for (let index = params; index > 1; index--) {
        hasil *= (index-1);
    }
    return hasil;
}

function reverseText(params) {
    let text = '';
    for (let index = params.trim().length; index > 0; index--) {
        text += params.charAt(index-1);
    }
    return text;
}

function numPhyramid(params) {
    let jumlah = String(params).trim().length;
    let hasil = '';
    let jmlNUll = jumlah;
    for (let index = 0; index < jumlah; index++) {
        hasil += String(params).charAt(index).padEnd(jmlNUll, '0')+'<br>';
        jmlNUll--;
    }
    return hasil;
}

function terbilang(angka)
{
    angka = parseInt(angka);
    const cara_baca = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
    let terbilang = '';

    if ( angka < 12 ) terbilang = cara_baca[angka];
    else if ( angka < 20 ) terbilang = this.terbilang(angka-10) + ' belas';
    else if ( angka < 100 ) terbilang = this.terbilang(angka/10) + ' puluh ' + this.terbilang(angka % 10);
    else if( angka > 100 ) terbilang = 'silahkan masukkan bilangan 1-100';
    
    return terbilang;
}
