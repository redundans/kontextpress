document.addEventListener( 'DOMContentLoaded', onReady );
function onReady() {
	let coversations = document.querySelectorAll( '.Conversation' );
	coversations.forEach(message => {
		if( message.nextElementSibling === null ){
			message.classList.add('Conversation--loc');
		} else if(
			(
				message.classList.contains('Conversation--rtl') &&
				message.nextElementSibling.classList.contains('Conversation--ltr')
			) ||
			(
				message.classList.contains('Conversation--ltr') &&
				message.nextElementSibling.classList.contains('Conversation--rtl')
			)
		) {
			message.classList.add('Conversation--loc');
		}
	});
	window.addEventListener('scroll', function() {
		let scrollprogress = document.getElementById("scrollprogress");
		if ( scrollprogress ) {
			let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
			let height = document.querySelector('.Article-content').scrollHeight + document.documentElement.clientHeight;
			let scrolled = (winScroll / height) * 100;
			scrollprogress.style.width = scrolled + "%";
		}
	});


	let loadmore = document.getElementById( 'loadmore' );
	loadmore.addEventListener('click', function(event) {
		event.preventDefault();
		let offset = parseInt(loadmore.dataset.offset);
		fetch('/wp-json/wp/v2/posts?per_page=9&offset='+offset).then(function (response) {
			// The API call was successful!
			return response.json();
		}).then(function (data) {
			// This is the JSON from our response
			loadmore.dataset.offset = parseInt(loadmore.dataset.offset) + parseInt(data.length);
			let template = wp.template( 'grid-template' );
			let grid = document.getElementById( 'loadmore-output' );
			data.forEach( post => {
				grid.innerHTML = grid.innerHTML + template( post );
			});
		}).catch(function (err) {
			// There was an error
			console.warn('Something went wrong.', err);
		});

	});
}
