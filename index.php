<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Pokemon Search</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<body>
    <h1>Pokemon Search</h1>
    
    <form id="pokemonForm">
        <label>Pokemon Name:</label>
        <input type="text" id="pokemonName" placeholder="Enter Pokemon name" required>
        <button type="submit">Get Pokemon</button>
    </form>
    
    <div id="result"></div>

    <script>
        document.getElementById('pokemonForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const name = document.getElementById('pokemonName').value;
            const resultWrapper = document.getElementById('result');
            
            if (!name) {
                return;
            }
            
            resultWrapper.innerHTML = 'Loading...';
            
            try {
                const response = await fetch(`api.php?name=${encodeURIComponent(name)}`);
                const data = await response.json();
                
                if (data.status_code === 200 && data.data) {
                    const pokemon = data.data;
                    resultWrapper.innerHTML = `
                        <h2>${pokemon.name}</h2>
                        <p>ID: ${pokemon.id}</p>
                        <p>Height: ${pokemon.height}</p>
                        <p>Weight: ${pokemon.weight}</p>
                        <img src="${pokemon.sprites.front_default}" alt="${pokemon.name}">
                        <h3>Stats:</h3>
                        <ul>
                            ${pokemon.stats.map(stat => `<li>${stat.stat.name}: ${stat.base_stat}</li>`).join('')}
                        </ul>
                        <h3>Types:</h3>
                        <ul>
                            ${pokemon.types.map(type => `<li>${type.type.name}</li>`).join('')}
                        </ul>
                    `;
                } else {
                    resultWrapper.innerHTML = `<p>Error: Pokemon not found</p>`;
                }
            } catch (error) {
                resultWrapper.innerHTML = `<p>Error: Pokemon not found</p>`;
                console.log(`${error.message}`);
            }
        });
    </script>
</body>
</html>
