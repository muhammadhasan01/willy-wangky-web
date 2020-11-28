var counter = 0
var list_bahan = []
var list_harga = []
var xmlhttp = new XMLHttpRequest();

xmlhttp.open('GET', 'http://localhost:8082/list?harga=true', false);
xmlhttp.onreadystatechange = function() {
  if (xmlhttp.readyState === 4) {
    if (xmlhttp.status === 200) {
        console.log(xmlhttp.response)
        let res = JSON.parse(xmlhttp.response);
        for (let i = 0; i < res.length; i++) {
            list_bahan.push(res[i]["nama"]);
        }
    }
  }
}
xmlhttp.send();

document.getElementById("tambah-bahan").addEventListener("click", () => {
    counter += 1
    bahan = "bahan-" + counter

    let tambah_bahan = document.getElementById("tambah-bahan");
    let form = document.getElementById("form-gila")

    let div_text_input = document.createElement("div")
    div_text_input.className = "text-input"

    let label_bahan = document.createElement("LABEL")
    label_bahan.htmlFor = bahan
    label_bahan.innerHTML = "Bahan"

    let select = document.createElement("SELECT")
    select.name = bahan
    select.id = bahan

    let list_option = []
    list_bahan.forEach((el) => {
        let option = document.createElement("OPTION")
        option.value = el
        option.innerHTML = el
        select.appendChild(option)
    })

    let jumlah = "jumlah-" + counter

    let label_jumlah = document.createElement("LABEL")
    label_jumlah.htmlFor = jumlah
    label_jumlah.innerHTML = "Jumlah"

    let input_jumlah = document.createElement("INPUT")
    input_jumlah.setAttribute("type", "number")
    input_jumlah.name = jumlah
    input_jumlah.id = jumlah
    input_jumlah.required = true

    div_text_input.appendChild(label_bahan)
    div_text_input.appendChild(select)
    div_text_input.appendChild(label_jumlah)
    div_text_input.appendChild(input_jumlah)

    form.insertBefore(div_text_input, form.childNodes[form.childNodes.length - 4])
})

document.getElementById("tambah-bahan").click()

document.getElementById("hapus-bahan").addEventListener("click", () => {
    const text_input = document.getElementsByClassName("text-input");
    const len = text_input.length;
    if (len == 4) return;
    let lastBahanToRemove = text_input[len - 1]
    lastBahanToRemove.remove()
})

document.getElementById("button-submit").addEventListener("click", () => {
    const text_input = document.getElementsByClassName("text-input");
    const len = text_input.length;
    xmlhttp.open("POST", 'http://localhost:8081/api/chocolate?wsdl', false)
    let params = '';
    for (let i = 1; i <= len - 4; i++) {
        const nama_bahan = document.getElementById("bahan-" + i).value
        const jumlah_bahan = document.getElementById("jumlah-" + i).value
        const euy = `<bahan><amount>${jumlah_bahan}</amount><name>${nama_bahan}</name></bahan>`;
        params += euy;
    }
    let body =  '<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">' +
                    '<Body>' +
                        '<addChocolate xmlns="http://service.willywangky/">' +
                            '<arg0 xmlns="">' + 
                                params +
                                '<chocolateName>' + document.getElementById("name").value + '</chocolateName>' +
                            '</arg0>'+
                        '</addChocolate>' +
                    '</Body>' +
                '</Envelope>';
    console.log(body)
    xmlhttp.setRequestHeader('Content-Type', 'text/xml');
    xmlhttp.send(body)

    console.log(document.getElementById("form-gila"))
    document.getElementById("button-bodoh").click()
})
