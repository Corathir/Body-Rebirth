
function change_lang() {
    let enLang = document.getElementsByClassName("en_lang");
    let rusLang = document.getElementsByClassName("rus_lang");
    let text = document.getElementById("change_lang");

    if (enLang[0].style.display === "inline-block") {
        for (let i = 0; i < enLang.length; i++)
            enLang[i].style.display = "none";
        for (let i = 0; i < rusLang.length; i++)
            rusLang[i].style.display = "inline-block";
        text.innerHTML = "Русский";

    } else {
        for (let i = 0; i < rusLang.length; i++)
            rusLang[i].style.display = "none";
        for (let i = 0; i < enLang.length; i++)
            enLang[i].style.display = "inline-block";
        text.innerHTML = "English";
    }
}