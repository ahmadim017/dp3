let fadeTarget = document.querySelector(".loading")

function show_loading(){
    fadeTarget.style.display ="block";
    fadeTarget.style.opacity = 1;
}

function hide_loading(){
    let fadeEffect = setInterval(() => {
        if (!fadeTarget.style.opacity){
            fadeTarget.style.opacity = 1;
        }
        if (!fadeTarget.style.opacity > 0){
            fadeTarget.style.opacity = 0.1;
        }else{
            fadeTarget.style.opacity = "none"
        }

    },100)
}
function tampil_data_ajax(){
    show_loading()
}
function hide_data_ajax(){
    hide_loading()
}
