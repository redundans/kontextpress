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
		let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
		let height = document.querySelector('.Article-content').scrollHeight + document.documentElement.clientHeight;
		let scrolled = (winScroll / height) * 100;
		document.getElementById("scrollprogress").style.width = scrolled + "%";
	});
}
