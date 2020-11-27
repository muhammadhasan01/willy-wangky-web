document.getElementById("search-button").addEventListener("click", () => {
    var search_bar = document.getElementById("search-bar");
    if (search_bar.value !== "") {
        window.location.href = `/src/search-result/search-result.php?name=${search_bar.value}`;
    }
})