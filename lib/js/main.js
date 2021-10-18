function save() {
    if (Boolean(checkInputs())) {
        alert("The field is empty!");
        return;
    }

    var sendData = {
        barcode: $("#barcode").val()
    }
    $.ajax({
        url: 'save.php',
        dataType: 'json',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(sendData),
        processData: false,
        success: function(data, textStatus, jQxhr) {
            console.log(data);
            displayStatus(data.message, data.type);
        },
        error: function(jqXhr, textStatus, errorThrown) {
            displayStatus(jqXhr.responseText, "error");
        }
    });
}

function displayStatus(message, stat) {
    switch (stat) {
        case "success":
            $("#alertSuccess").text(message);
            $("#alertSuccess").show();
            $("#alertSuccess").delay(3000).fadeOut("slow", function() {});
            resetInputs();
            break;
        case "error":
            $("#alertFail").text(message);
            $("#alertFail").show();
            $("#alertFail").delay(20000).fadeOut("slow", function() {});
            break;
    }
}

function resetInputs() {
    $("#barcode").val("");
}

function checkInputs() {
    var error = 0;

    if (!$("#barcode").val()) {

        error = 1;

    }

    return error;
}