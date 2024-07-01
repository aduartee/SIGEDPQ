function showFields() {
    const fields = document.getElementById('fields');
    const calculationType = document.getElementById('calculation_type');
    let fieldHTML = '';
    switch (calculationType.value) {
        case 'mass_mass':
            fieldHTML += '<label for="mass_solute">Massa do soluto (g):</label>';
            fieldHTML += '<input type="number" id="mass_solute" step="0.01"><br>';
            fieldHTML += '<label for="mass_solution">Massa da solução (g):</label>';
            fieldHTML += '<input type="number" id="mass_solution" step="0.01"><br>';
            fieldHTML += '<label for="result_value">Resultado (%):</label><br>';
            fieldHTML += '<input type="number" id="result_value" step="0.01"><br>';
            break;
        case 'volume_volume':
            fieldHTML += '<label for="volume_solute">Volume do soluto (ml):</label>';
            fieldHTML += '<input type="number" id="volume_solute" step="0.01"><br>';
            fieldHTML += '<label for="volume_solution">Volume da solução (ml):</label>';
            fieldHTML += '<input type="number" id="volume_solution" step="0.01"><br>';
            fieldHTML += '<label for="result_value">Resultado (%):</label><br>';
            fieldHTML += '<input type="number" id="result_value" step="0.01"><br>';
            break;
        case 'molarity':
            fieldHTML += '<label for="moles_solute">Número de mols de soluto:</label>';
            fieldHTML += '<input type="number" id="moles_solute" step="0.01"><br>';
            fieldHTML += '<label for="volume_solution">Volume da solução (L):</label>';
            fieldHTML += '<input type="number" id="volume_solution" step="0.01"><br>';
            fieldHTML += '<label for="result_value">Resultado (M):</label><br>';
            fieldHTML += '<input type="number" id="result_value" step="0.01"><br>';
            break;
        case 'molality':
            fieldHTML += '<label for="moles_solute">Número de mols de soluto:</label>';
            fieldHTML += '<input type="number" id="moles_solute" step="0.01"><br>';
            fieldHTML += '<label for="mass_solvent">Massa do solvente (kg):</label>';
            fieldHTML += '<input type="number" id="mass_solvent" step="0.01"><br>';
            fieldHTML += '<label for="result_value">Resultado (mol/kg):</label><br>';
            fieldHTML += '<input type="number" id="result_value" step="0.01"><br>';
            break;
        case 'normality':
            fieldHTML += '<label for="equivalents_solute">Número de equivalentes-grama de soluto:</label>';
            fieldHTML += '<input type="number" id="equivalents_solute" step="0.01"><br>';
            fieldHTML += '<label for="volume_solution">Volume da solução (L):</label>';
            fieldHTML += '<input type="number" id="volume_solution" step="0.01"><br>';
            fieldHTML += '<label for="result_value">Resultado (N):</label><br>';
            fieldHTML += '<input type="number" id="result_value" step="0.01"><br>';
            break;
        case 'mole_fraction':
            fieldHTML += '<label for="moles_component">Número de mols do componente:</label>';
            fieldHTML += '<input type="number" id="moles_component" step="0.01"><br>';
            fieldHTML += '<label for="total_moles">Número total de mols na solução:</label>';
            fieldHTML += '<input type="number" id="total_moles" step="0.01"><br>';
            fieldHTML += '<label for="result_value">Resultado:</label><br>';
            fieldHTML += '<input type="number" id="result_value" step="0.01"><br>';
            break;
    }

    fields.innerHTML = fieldHTML;
}

function calculate() {
    const calculationType = document.getElementById('calculation_type').value;
    let result;
    let unit;

    switch (calculationType) {
        case 'mass_mass':
            const massSolute = parseFloat(document.getElementById('mass_solute').value);
            const massSolution = parseFloat(document.getElementById('mass_solution').value);
            const resultValueMass = parseFloat(document.getElementById('result_value').value);

            if (!isNaN(massSolute) && !isNaN(massSolution)) {
                result = (massSolute / massSolution) * 100;
                unit = '%';
            } else if (!isNaN(massSolute)) {
                result = massSolute / (resultValueMass / 100);
                unit = 'g de solução';
            } else {
                result = (resultValueMass / 100) * massSolution;
                unit = 'g de soluto';
            }
            break;
        case 'volume_volume':
            const volumeSolute = parseFloat(document.getElementById('volume_solute').value);
            const volumeSolution = parseFloat(document.getElementById('volume_solution').value);
            const resultValueVolume = parseFloat(document.getElementById('result_value').value);

            if (!isNaN(volumeSolute) && !isNaN(volumeSolution)) {
                result = (volumeSolute / volumeSolution) * 100;
                unit = '%';
            } else if (!isNaN(volumeSolute)) {
                result = volumeSolute / (resultValueVolume / 100);
                unit = 'ml de solução';
            } else {
                result = (resultValueVolume / 100) * volumeSolution;
                unit = 'ml de soluto';
            }
            break;
        case 'molarity':
            const molesSolute = parseFloat(document.getElementById('moles_solute').value);
            const volumeSolutionL = parseFloat(document.getElementById('volume_solution').value);
            const resultValueMolarity = parseFloat(document.getElementById('result_value').value);

            if (!isNaN(molesSolute) && !isNaN(volumeSolutionL)) {
                result = molesSolute / volumeSolutionL;
                unit = 'M';
            } else if (!isNaN(molesSolute)) {
                result = molesSolute / resultValueMolarity;
                unit = 'L de solução';
            } else {
                result = resultValueMolarity * volumeSolutionL;
                unit = 'mols de soluto';
            }
            break;
        case 'molality':
            const molesSoluteMolality = parseFloat(document.getElementById('moles_solute').value);
            const massSolvent = parseFloat(document.getElementById('mass_solvent').value);
            const resultValueMolality = parseFloat(document.getElementById('result_value').value);

            if (!isNaN(molesSoluteMolality) && !isNaN(massSolvent)) {
                result = molesSoluteMolality / massSolvent;
                unit = 'mol/kg';
            } else if (!isNaN(molesSoluteMolality)) {
                result = molesSoluteMolality / resultValueMolality;
                unit = 'kg de solvente';
            } else {
                result = resultValueMolality * massSolvent;
                unit = 'mols de soluto';
            }
            break;
        case 'normality':
            const equivalentsSolute = parseFloat(document.getElementById('equivalents_solute').value);
            const volumeSolutionN = parseFloat(document.getElementById('volume_solution').value);
            const resultValueNormality = parseFloat(document.getElementById('result_value').value);

            if (!isNaN(equivalentsSolute) && !isNaN(volumeSolutionN)) {
                result = equivalentsSolute / volumeSolutionN;
                unit = 'N';
            } else if (!isNaN(equivalentsSolute)) {
                result = equivalentsSolute / resultValueNormality;
                unit = 'L de solução';
            } else {
                result = resultValueNormality * volumeSolutionN;
                unit = 'equivalentes-grama de soluto';
            }
            break;
        case 'mole_fraction':
            const molesComponent = parseFloat(document.getElementById('moles_component').value);
            const totalMoles = parseFloat(document.getElementById('total_moles').value);
            const resultValueMoleFraction = parseFloat(document.getElementById('result_value').value);

            if (!isNaN(molesComponent) && !isNaN(totalMoles)) {
                result = molesComponent / totalMoles;
                unit = '';
            } else if (!isNaN(molesComponent)) {
                result = molesComponent / resultValueMoleFraction;
                unit = 'mols totais';
            } else {
                result = resultValueMoleFraction * totalMoles;
                unit = 'mols do componente';
            }
            break;
    }

    document.getElementById('result').textContent = `Resultado: ${result} ${unit}`;
}
