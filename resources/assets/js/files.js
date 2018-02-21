$(document).ready(function(){
    const quarter = document.getElementsByName("Quarter")[0];
    const year = document.getElementsByName("Year")[0];
    const searchbox = document.getElementsByName("Searchbox")[0];

    const handleSearch = function(){

        document.querySelectorAll('.single-file').forEach(function(file) {
            if(file.textContent.toLowerCase().includes(searchbox.value.toLowerCase())){
                file.classList.remove("hidden")
            }
            else {
                file.classList.add("hidden");
            }
        });               
    }

    const handleFilter = function(){
        document.querySelectorAll('.single-file').forEach(function(file) {
            if(file.classList.contains(quarter.value) && file.classList.contains(year.value)){
                file.classList.remove("hidden")
            } else {
                file.classList.add("hidden");
            }
        });            
    }

    handleFilter();

    searchbox.addEventListener("keyup", handleSearch);
    quarter.addEventListener("change", handleFilter);
    year.addEventListener("change", handleFilter);

});