	var cur = 0;
	
	window.onload = init();
	
	function init()
	{
		setInterval(function() {
			changeSlide(1);
		}, 8000);
	}
	

function changeSlide(direction)
{

	var photos = ['Images/armchair-business-computer-1532621.jpg', 'Images/chair-clock-computer-373883.jpg', 'Images/ai-blur-codes-577585.jpg', 'Images/ai-codes-coding-97077.jpg'];
	var activeImg = document.getElementById('activeImg');
	
	if (direction >= 0)
	{
		if (cur == photos.length-1)
		{
			cur = 0;
			activeImg.src = photos[cur];
		}
		
		else
		{
			cur = cur+1;
			activeImg.src = photos[cur];
		}
	}
	
	else
	{
		if (cur == 0)
		{
			cur = photos.length-1;
			activeImg.src = photos[cur];
		}
		
		else
		{
			cur = cur-1;
			activeImg.src = photos[cur];
		}
	}
	
}

