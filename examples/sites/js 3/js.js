/* 
 * StAuth10065: I Jobanpreet Singh Aulakh, 000381413 certify that this material is my original work. No other person's work has been used without due acknowledgement. I have not made my work available to anyone else.
 */
var data = [{price: "$240,199.00", image: "colonial.jpg", description: "Colonial House, 4 Bedrooms, 2 Baths, Heated Garage"},
    {price: "$199,199.00", image: "contemporary.jpg", description: "Contemporary House, for immediate sale, Jacuzzi and Hot Tub"},
    {price: "$49,500.00", image: "cottage.jpg", description: "Cottage on a Lake, rustic, wood stove, no water, no heat"},
    {price: "$149,999.00", image: "ranch.jpg", description: "Ranch with large barn and a stable of horses. Big Tractor too."},
    {price: "$499,499.00", image: "townhouse.jpg", description: "Townhouse property in center of town. Near bus route!!!"}
];
var n = 0;
$(document).ready(function () {
    $("#next,#previous").hover(function () {
        $(this).children("#next_blue,#previous_blue").toggleClass("over");
    });
    calculate();
    $("#next").click(function () {
        if (n === 4) {
            n = 0;
        } else {
            n++;
        }
        calculate();
    });
    $("#previous").click(function () {
        if (n === 0) {
            n = 4;
        } else {
            n--;
        }
        calculate();
    });
    $("#image").click(function () {
        Summary();
    });
});
function clear() {
    document.getElementById("price").innerText = "";
    document.getElementById("image").innerHTML = "";
    document.getElementById("description").innerText = "";
}
function calculate() {
    clear();
    var price = "Priced at: " + data[n].price;
    document.getElementById("price").innerText = price;
    var img = document.createElement("img");
    img.src = ".\\images\\" + data[n].image;
    document.getElementById("image").appendChild(img);
    var des = (n + 1) + ": " + data[n].description;
    document.getElementById("description").innerText = des;
}
function Summary() {
    var myWindow = window.open("./popup.html", "_blank", "width=465,height=405");
    myWindow.window.onload = function () {
        myWindow.document.getElementById("table").innerHTML = "";
        var table = myWindow.document.createElement("table");
        for (var row = 0; row < 5; row++) {
            var tr = myWindow.document.createElement("tr");
            for (var col = 0; col < 3; col++) {
                var td = myWindow.document.createElement("td");
                tr.appendChild(td);
                switch (col) {
                    case 0:
                        var img = myWindow.document.createElement("img");
                        img.src = "./images/" + data[row].image;
                        td.appendChild(img);
                        break;
                    case 1:
                        td.innerHTML = data[row].description;
                        break;
                    case 2:
                        td.innerHTML = data[row].price;
                        break;
                }
            }
            table.appendChild(tr);
        }
        myWindow.document.getElementById("table").appendChild(table);
        myWindow.document.getElementById("close").onclick = function () {
            myWindow.close();
        };
    };
}

