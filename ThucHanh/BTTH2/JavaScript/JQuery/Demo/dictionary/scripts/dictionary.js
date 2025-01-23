// letter A
$(document).ready(function() {
	$('#letter-a a').click(function() {
		$('#dictionary').hide().load('data/a.html', function() {
			$(this).fadeIn();
		});
		return false;
	});
});
// letter B
$(document).ready(function() {
	$('#letter-b a').click(function() {
		$.getJSON('data/b.json', function(data) {
			$('#dictionary').empty();
			$.each(data, function(entryIndex, entry) {
				var html = '<div class="entry">';
				html += '<h3 class="word">' + entry['word'] + '</h3>';
				html += '<div class="type">' + entry['type'] + '</div>';
				if (entry['means']) {
					html += '<div class="means">';
					$.each(entry['means'], function(lineIndex, line) {
						html += '<div class="mean">' + line + '</div>';
					});
					html += '</div>';
				}
				html += '</div>';
				$('#dictionary').append(html);
			});
		});
		return false;
	});
});
// letter C
$(document).ready(function() {
	$('#letter-c a').click(function() {
		$.getScript('data/c.js');
		return false;
	});
});
// Letter D
$(document).ready(function() {
	$('#letter-d a').click(function() {
		$.get('data/d.xml', function(data) {
			$('#dictionary').empty();
			$(data).find('entry').each(function() {
				var $entry = $(this);
				var html = '<div class="entry">';
				html += '<h3 class="word">' + $entry.attr('word') + '</h3>';
				html += '<div class="type">' + $entry.attr('type') + '</div>';
				var $means = $entry.find('means');
				if ($means.length) {
					$means.each(function() {
						html += '<div class="mean">' + $(this).text() + '</div>';
					});
				}
				html += '</div>';
				$('#dictionary').append($(html));
			});
		});
		return false;
	});
});