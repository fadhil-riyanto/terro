var current_command_index = previous_commands.length - 1;

document.getElementById('command').select();
document.getElementById('terminal').scrollTop = document.getElementById('terminal').scrollHeight;

function command_keyed_down(event) {
    var key_code = event.keyCode;
    if (key_code == 38) {
        fill_in_previous_command();
    } else if (key_code == 40) {
        fill_in_next_command();
    } else if (key_code == 13) {
        if (event.shiftKey) {
            document.getElementById('commands').submit();
            return false;
        }
    }
    return true;
}

function fill_in_previous_command() {
    current_command_index--;
    if (current_command_index < 0) {
        current_command_index = 0;
        return;
    }
    document.getElementById('command').value = previous_commands[current_command_index];
}

function fill_in_next_command() {
    current_command_index++;
    if (current_command_index >= previous_commands.length) {
        current_command_index = previous_commands.length - 1;
        return;
    }
    document.getElementById('command').value = previous_commands[current_command_index];
}

$("document").ready(function() {

    var hash = window.location.hash;

    setTimeout(function() {
        $("a[href='"+hash+"']").click();
    }, 200);



    $(".menu li:not(.logo)").click(function() {
        $(".content").hide();
        $(".menu li").removeClass("active");
        $(this).addClass("active");

        var target = $("a", this).attr("data-target");
        $(".content[data-content='"+target+"']").show();
    });
});