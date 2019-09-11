NetworkStatus();
$(document).on('offline online', function (event) {
    alert("You just went " + event.type + "!");
    NetworkStatus();
});
LocalStorage();
CheckRequired();
CheckDate();
CheckEmail();
CheckNumber();
CheckPattern();

function CheckPattern() {
    if (Modernizr.input.pattern) {
        $("#code-Support").html('<span class="label label-success">Pattern attribute supported</span>');
    } else {
        $("#code-Support").html('<span class="label label-danger">Pattern attribute NOT supported</span>');
    }
}
function CheckNumber() {
    if (Modernizr.inputtypes.number) {
        $("#age-Support").html('<span class="label label-success">Number type supported</span>');
    } else {
        $("#age-Support").html('<span class="label label-danger">Number type NOT supported</span>');
    }
}
function CheckEmail() {
    if (Modernizr.inputtypes.email) {
        $("#email-Support").html('<span class="label label-success">Email type supported</span>');
    } else {
        $("#email-Support").html('<span class="label label-danger">Email type NOT supported</span>');
    }
}
function CheckDate() {
    if (Modernizr.inputtypes.date) {
        $("#date-Support").html('<span class="label label-success">Date type supported</span>');
    } else {
        $("#date-Support").html('<span class="label label-danger">Date type NOT supported</span>');
    }
}
function CheckRequired() {
    if (Modernizr.input.required) {
        $("#name-Support").html('<span class="label label-success">Required attribute supported</span>');
    } else {
        $("#name-Support").html('<span class="label label-danger">Required attribute NOT supported</span>');
    }
}
function LocalStorage() {
    if (Modernizr.localstorage) {
        $("#LocalStorage").html('<span class="label label-success">Supported</span>');
    } else {
        $("#LocalStorage").html('<span class="label label-danger">Unsupported</span>');
    }
}
function NetworkStatus() {
    if (navigator.onLine) {
        $("#NetworkStatus").html('<span class="label label-success">Online</span>');
    } else {
        $("#NetworkStatus").html('<span class="label label-danger">Offline</span>');
    }
}
function PopulateForm() {
    $("#name").val("Joban Aulakh");
    $("#date").val("1995-09-02");
    $("#email").val("Joban@Aulakh.ca");
    $("#age").val("21");
    $("#code").val("L9C 6C9");
    $("#music").prop("checked", true);
    $("#software").prop("checked", true);
    $("#male").prop("checked", true);
    $("#Quebec").prop("selected", true);
    $("#Saskatchewan").prop("selected", true);

}

//serializeObject function from pravasini.wordpress.com/tag/serializeobject/
$.fn.serializeObject = function ()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
$(".form-horizontal").submit(function (event) {
    if (!navigator.onLine) {
        event.preventDefault();
        SaveToLocalStorage()
        $("#info").html("<span class='label label-danger'>Since we are OFFLINE! Form values have been saved to Local Storage.</span>");
    } else {
        return true;
    }
});
function SaveToLocalStorage() {
    formData = $(".form-horizontal").serializeObject();
    localStorage.setItem('localFormData', JSON.stringify(formData));
    $("#info").html('<span class="label label-warning">Form Values have been saved to Local Storage</span>');
}
function ClearLocalStorage() {
    localStorage.removeItem('localFormData');
    $(".form-horizontal").trigger("reset");
    $("#info").html('<span class="label label-warning">Local Storage is destroyed and form has been cleared</span>');
}
function LoadFromLocalStorage() {
    $(".form-horizontal").trigger("reset");
    readFormData = JSON.parse(localStorage.getItem('localFormData'));
    $("#name").val(readFormData.name);
    $("#date").val(readFormData.date);
    $("#email").val(readFormData.email);
    $("#age").val(readFormData.age);
    $("#code").val(readFormData.code);
    $.each(readFormData.interests, function (index, value) {
        var x = '#' + value + '';
        $(x).prop("checked", true);
    });
    $("#" + readFormData.gender).prop("checked", true);
    $.each(readFormData.province, function (index, value) {
        var x = '#' + value + '';
        $(x).prop("selected", true);
    });
    $("#info").html('<span class="label label-warning">Form has been loaded with values retrieved from Local Storage</span>');
}