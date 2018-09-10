$(function()
{	
	$("#table").tablesorter(
	{
		headers: {4: {sorter: false}},
		textExtraction: "replace",
		replaceSymbol: "$"
	});
});