app.filter('arr2str', function() {
  return function(input,link) {
  	var links = JSON.parse(input);
  	var str   = '';
  	 links.forEach(function(post){
  				str +=  '<a href="'+post+'" target="_blank"> ' + post + ' </a>,'
  	});
  	 if(link) return str;

    return links.toString();
  };
});