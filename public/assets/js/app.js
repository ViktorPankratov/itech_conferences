let reg_checkbox = document.getElementById('with_lecture')
$(".lecture-form-data-card").hide();
reg_checkbox.addEventListener('change', (event) => {
    if (event.target.checked) {
        $(".lecture-form-data-card").slideDown("slow");
    } else {
        $(".lecture-form-data-card").slideUp("slow");
    }
})
