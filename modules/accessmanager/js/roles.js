$(function()
{	
	$("#table").tablesorter(
	{
		headers: {1: {sorter: false}},
		textExtraction: "replace",
		replaceSymbol: "$"
	});
});