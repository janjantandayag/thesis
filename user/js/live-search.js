$(document).ready(function(){
	$('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'search.php?emotion=%QUERY',
        limit : 10
    });
});