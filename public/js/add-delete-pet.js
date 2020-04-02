const addPetBtn = document.querySelector('#add-pet-btn');
const deletePetBtn = document.querySelector('#delete-pet-btn');
const groupInputFields = document.querySelector('.group-input-fields');

const petNameField = document.querySelector('.pet-name');

addPetBtn.onclick = () => {
    let clonedPetNameField = petNameField.cloneNode(true);
    clonedPetNameField.value = "";
    groupInputFields.appendChild(clonedPetNameField);

    groupInputFields.childElementCount >= 1 ? deletePetBtn.style.display = "inline-block" : deletePetBtn.style.display = "none";
   
}


deletePetBtn.onclick = () => {
    let index = groupInputFields.childElementCount;
    groupInputFields.removeChild(groupInputFields.childNodes[index]);

    groupInputFields.childElementCount >=1 ? deletePetBtn.style.display = "inline-block" : deletePetBtn.style.display = "none";
}
