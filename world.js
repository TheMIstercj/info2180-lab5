document.addEventListener('DOMContentLoaded', () => {
    const countryInput = document.getElementById('country');
    const countriesButton = document.getElementById('lookup');
    const citiesButton = document.getElementById('lookup-cities');
    const result = document.getElementById('result');

    async function lookup(type) {
        const params = new URLSearchParams({ country: countryInput.value.trim() });

        if (type === 'cities') {
            params.set('lookup', 'cities');
        }

        countriesButton.disabled = true;
        citiesButton.disabled = true;
        result.textContent = 'Loading...';

        try {
            const response = await fetch(`world.php?${params.toString()}`);

            if (!response.ok) {
                throw new Error('The request was not successful.');
            }

            result.innerHTML = await response.text();
        } catch (error) {
            result.textContent = 'Could not load the results. Please check Apache and MySQL.';
            console.error(error);
        } finally {
            countriesButton.disabled = false;
            citiesButton.disabled = false;
        }
    }

    countriesButton.addEventListener('click', () => lookup('countries'));
    citiesButton.addEventListener('click', () => lookup('cities'));

    countryInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            lookup('countries');
        }
    });
});
