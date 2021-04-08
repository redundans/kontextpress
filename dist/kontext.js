const kontextAPI = {
	get( endpoint ) {
		return window.fetch( endpoint, {
		method: 'GET',
		headers: { 'Accept': 'application/json' }
		} )
		.then( this._handleError )
		.then( this._handleContentType )
		.catch( this._throwError );
	},

	post( endpoint, body ) {
		return window.fetch( endpoint, {
		method: 'POST',
		headers: { 'content-type': 'application/json' },
		body: JSON.stringify( body ),
		} )
		.then( this._handleError )
		.then( this._handleContentType )
		.catch( this._throwError );
	},

	_handleError( err ) {
		return err.ok ? err : Promise.reject( err.statusText )
	},

	_handleContentType( res ) {
		const contentType = res.headers.get( 'content-type' );
		if( contentType && contentType.includes( 'application/json' ) ) {
		return res.json()
		}
		return Promise.reject( 'Oops, we haven\'t got JSON!' )
	},

	_throwError( err ) {
		throw new Error( err );
	}
}

document.addEventListener( 'DOMContentLoaded', onReady );
function onReady() {
	let template = wp.template( 'comment-single' );
	let loadMoreButton = document.querySelector( '#more_posts' );
	let target = document.querySelector( '#ajax-load' );

	// listener to load next page
	loadMoreButton.addEventListener( 'click', function(event) {
		event.preventDefault();
		kontextAPI.get( '/wp-json/wp/v2/posts?per_page=2&page=' + 1 ).then( result => {
			result.forEach(post => {
				let article = template( post );
				target.innerHTML = target.innerHTML + article;
			});
		} );
	});
}

