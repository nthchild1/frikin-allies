import React from 'react';

const Suggestions = (props) => {
	const options = props.results.map(place => (
		<li key={place.id}>
			<button
				className={'custom-button'}
				onClick={() => props.handleButtonClick(place)}
			>
				{place.title}
			</button>
		</li>
	));
	return <ul>{options}</ul>;
};

export default Suggestions;
