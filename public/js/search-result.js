let search_results = document.getElementsByClassName("container")[0].getElementsByClassName("card");
let pagination = document.getElementsByClassName("pagination")[0];
let pagination_number_template = document.getElementById("1");

const PAG_LEN = 3;
const NUM_OF_PAGES = Math.floor(search_results.length / PAG_LEN) + 1;

pagination.innerHTML = "";

for (let i = 0; i < search_results.length; i++) {
    search_results[i].style["display"] = "none";
}


for (let i = 0; i < NUM_OF_PAGES; i++) {
    let number_to_insert = pagination_number_template.cloneNode();
    number_to_insert.id = `${i + 1}`;
    // console.log(number_to_insert.id);
    number_to_insert.innerHTML = i + 1 + "";
    pagination.appendChild(number_to_insert);
}

let pagination_numbers = document.getElementsByClassName("page");

// GABISA PAKE VAR, JANGAN PERNAH PAKE VAR LAGI
for (let i = 0; i < NUM_OF_PAGES; i++) {
    let pagination_number = document.getElementById(`${i + 1}`);
    pagination_number.addEventListener("click", () => {
        for (j = 0; j < search_results.length; j++) {
            if (j >= i * PAG_LEN && j < i * PAG_LEN + PAG_LEN) {
                search_results[j].style["display"] = "";
            } else {
                search_results[j].style["display"] = "none";
            }
        }
        for (j = 0; j < NUM_OF_PAGES; j++) {
            if (i === j) {
                pagination_numbers[j].classList.add("active");
            } else {
                if (pagination_numbers[j].classList.contains("active")) {
                    pagination_numbers[j].classList.remove("active");
                }
            }
        }
    });
}

document.getElementById("1").click();