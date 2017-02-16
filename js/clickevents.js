$(document).ready(function() {
    $('#Garage').click(function() {
            showSensor(1);
    });
});
$(document).ready(function() {
    $('#Kitchen').click(function() {
            showSensor(2);
    });
});
$(document).ready(function() {
    $('#Livingroom').click(function() {
            showSensor(3);
    });
});
$(document).ready(function() {
    $('#Hall').click(function() {
            showSensor(4);
    });
});
$(document).ready(function() {
    $('#Bedroom').click(function() {
            showSensor(5);
    });
});
$(document).ready(function() {
    $('#Playroom').click(function() {
            showSensor(6);
    });
});
$(document).ready(function() {
    $('#Bathroom').click(function() {
            showSensor(7);
    });
});
$(document).mouseup(function (e)
{
    var container = $("#dialog");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.hide();
    }
});
$(document).ready(function() {
    $('#plus').click(function() {
            $('#form').slideToggle("fast","swing");
    });
});
$(document).ready(function() {
    $('#closed').click(function() {
            $('#form').slideToggle("fast","swing");
    });
});
$(document).ready(function() {
    $('#remove').click(function() {
            $('#form2').slideToggle("fast","swing");
    });
});
$(document).ready(function() {
    $('#closed2').click(function() {
            $('#form2').slideToggle("fast","swing");
    });
});