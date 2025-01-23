var entries = [{
	"word": "concept",
	"type": "danh từ",
	"mean": "khái niệm, quan niệm."
},
{
	"word": "connect",
	"type": "động từ",
	"mean": "nối,kết nối, chấp lại."
},
{
	"word": "color",
	"type": "danh từ",
	"mean": "màu sắc."
},
{
	"word": "celebrate",
	"type": "động từ",
	"mean": "kỷ niệm, làm kỷ niệm"
},
{
	"word": "comfort",
	"type": "danh từ",
	"mean": "sự an ũi, sự khuyên giải; người an ũi, người khuyên giải; người an ũi, lời an ũi"
}];
var html = '';
$.each(entries, function() {
	html += '<div class="entry">';
	html += '<h3 class="word">' + this['word'] + '</h3>';
	html += '<div class="type">' + this['type'] + '</div>';
	html += '<div class="mean">' + this['mean'] + '</div>';
	html += '</div>';
});
$('#dictionary').html(html);