// Образец Использования AJAX

function funcBefore() {
    $("#information").text("Ожидание данных..."); // show() \ hide()
}
function funcSuccess(data) {
    $("#information").text(data);
}
$(document).ready(function() {
    // 1
    $("#load").bind("click", function() {
        var admin = "Admin";
        $.ajax({
            url: "content.php", // Скрипт, который надо выполнить
            type: "POST", // Тип запроса
            data: ({ name: admin, number: 5 }), // Переменные, которые необходимо передать скрипту (ОПЦ)
            dataType: "html", // Тип передаваемой информации (с "html" можно передавать теги) ("text")
            beforeSend: funcBefore, // Что-то, выполняемое, пока документ загружается (Скобки для функции не ставятся, чтобы не выполнялось моментально) (ОПЦ)
            success: funcSuccess // Вызывается, когда функция дала ответ (успешный или ошибку)
        });
    });
    // 2
    $("#done").bind("click", function() {
        $.ajax({
            url: "check.php",
            type: "POST",
            data: ({ name: $("#name").val() }),
            dataType: "html",
            beforeSend: function() {
                $("#information").text("Ожидание данных...");
            },
            success: function(data) {
                if (data == 'Fail')
                    alert("Имя занято");
                else
                    $("#information").text(data);
            }
        });
    });
});
//