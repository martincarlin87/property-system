const newAgentForm = document.querySelector('#new-agent-form');
const assignAgentForm = document.querySelector('#assign-agent-form');

document.addEventListener('DOMContentLoaded', function() {
    newAgentForm.addEventListener('submit', addNewAgent);
    assignAgentForm.addEventListener('submit', assignAgent);

    const agentSelect = new Choices('select[name="agent"]', {
        allowHTML: false,
        placeholder: true,
        placeholderValue: 'Choose an agent',
        maxItemCount: 10,
    }).setChoices(function() {
        return fetch(
            agentsApiEndpoint
        )
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                return data.data.map(function(agent) {
                    return { value: agent.id, label: agent.name };
                });
            });
    });

    const config = {
        allowHTML: false,
        placeholder: true,
        placeholderValue: 'Choose a property',
        maxItemCount: 20,
    }
    const propertySelect = document.querySelector('select[name="property"]');
    const propertyChoice = new Choices(propertySelect, config);

    let myTimeOut = null;
    propertySelect.addEventListener('search', async (e) => {

        if (e.detail.value) {

            clearTimeout(myTimeOut);

            myTimeOut = setTimeout(() => {
                propertyChoice.setChoices(async () => {
                    return fetch(
                        // below api is only used for this example. it doesn't support query filtering, but its returns some data.
                        `${propertiesApiEndpoint}?search=${e.detail.value}`
                    )
                        .then(function (response) {
                            return response.json();
                        })
                        .then(function (data) {
                            return data.data.map(function (property) {
                                return {value: property.id, label: property.address};
                            });
                        });
                })
            }, 1000);
        }
    });
});

function addNewAgent(e) {

    e.preventDefault();

    let formData = new FormData(newAgentForm);

    Swal.fire({
        title: 'Adding New Agent',
        html: 'Please wait...',
        allowEscapeKey: false,
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading()
        }
    });

    axios({
        method: newAgentForm.method,
        url: newAgentForm.action,
        data: formData,
    })
        .then(function (response) {

            Swal.close();

            Swal.fire({
                title: 'Success',
                text: 'Agent has been created successfully',
                icon: 'success',
            })

            newAgentForm.reset();

        })
        .catch(function (error) {

            Swal.close();

            Swal.fire({
                title: 'Error',
                text: error.response.data.message,
                icon: 'error',
            })

            const labels = document.querySelectorAll('.form-control label');

            for (const label of labels) {
                label.classList.remove('text-red-400');
            }

            const errorMessages = document.querySelectorAll('.error');

            for (const errorMessage of errorMessages) {
                errorMessage.textContent = '';
            }

            let i = 0;
            for (const property in error.response.data.errors) {
                const input = document.querySelector(`[name="${property}"]`);

                // scroll to first error
                if (i === 0) {

                    setTimeout(function() {
                        window.scrollTo({
                            top: input.offsetTop - 50,
                            behavior: 'smooth'
                        });
                    }, 500);
                }

                input.closest('.form-control').querySelector('label').classList.add('text-red-400');
                input.closest('.form-control').querySelector('.error').textContent = error.response.data.errors[property][0];

                i++;
            }
        });
}

function assignAgent(e) {

    e.preventDefault();

    let formData = new FormData(assignAgentForm);

    Swal.fire({
        title: 'Assigning Agent To Property',
        html: 'Please wait...',
        allowEscapeKey: false,
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading()
        }
    });

    axios({
        method: assignAgentForm.method,
        url: assignAgentForm.action,
        data: formData,
    })
        .then(function (response) {

            Swal.close();

            Swal.fire({
                title: 'Success',
                text: 'Agent has been assigned successfully',
                icon: 'success',
            })

        })
        .catch(function (error) {

            Swal.close();

            Swal.fire({
                title: 'Error',
                text: error.response.data.message,
                icon: 'error',
            })

            const labels = document.querySelectorAll('.form-control label');

            for (const label of labels) {
                label.classList.remove('text-red-400');
            }

            const errorMessages = document.querySelectorAll('.error');

            for (const errorMessage of errorMessages) {
                errorMessage.textContent = '';
            }

            let i = 0;
            for (const property in error.response.data.errors) {
                const input = document.querySelector(`[name="${property}"]`);

                // scroll to first error
                if (i === 0) {

                    setTimeout(function() {
                        window.scrollTo({
                            top: input.offsetTop - 50,
                            behavior: 'smooth'
                        });
                    }, 500);
                }

                input.closest('.form-control').querySelector('label').classList.add('text-red-400');
                input.closest('.form-control').querySelector('.error').textContent = error.response.data.errors[property][0];

                i++;
            }
        });
}
