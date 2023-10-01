var navigationItems = [
    {
        name: "Info",
        href: "https://github.com/MrSvch0st/info",
        icon: "fas fa-home",
    },
    {
        name: "MalwareDatabse",
        href: "https://github.com/MrSvch0st/Malware",
        icon: "fab fa-windows",
    },
    {
        name: "NedoHackers",
        href: "https://mrsvch0st.github.io/nedohackers",
        icon: "fa fa-exclamation-triangle",
    },
                      ]


function createItem(item) {
    var i = document.createElement("i");
    i.className = item.icon;

    var icon = document.createElement("span");
    icon.className = "icon";
    icon.appendChild(i);

    var title = document.createElement("span");
    title.className = "title";
    title.title = item.name;
    title.innerHTML = item.name;

    var a = document.createElement("a");
    a.href = item.href;
    a.appendChild(icon);
    a.appendChild(title);

    var li = document.createElement("li");
    if (item.onclick) { li.addEventListener("click", item.onclick) };
    li.appendChild(a);

    var navigation = document.querySelector(".navigationContainer .navigation ul");
    navigation.appendChild(li);
}


navigationItems.forEach(item => { createItem(item); });
document.getElementsByClassName("toggle")[0].click();