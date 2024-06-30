async function carregarVacinas(idAtendimento) {
    const headers = new Headers({
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
    });

    try {
        let request = await fetch('/vacina/adicionar-aplicacao/' + idAtendimento, {
            method: 'GET',
            headers: headers,
            credentials: 'same-origin'
        });

        let response = await request.json();

        if (response.success) {
            await adicionarOptions(response.vacinas);
            return;
        }

        alert(response.message);
        document.querySelector('#fecharModal').click();
    } catch (e) {
        alert(e);
    }
}

async function adicionarOptions(vacinas) {
    let select = document.querySelector('#vacina');
    let option = null;

    vacinas.forEach(element => {
        option = document.createElement('option');
        option.value = element.id;
        option.innerHTML = `${element.nome} (${element.id})`;
        select.add(option);
    });
}

async function adicionarAplicacao(idAtendimento) {
    let select = document.querySelector('#vacina');

    if(select.value === ''){
        alert('Selecione uma vacina!');
        return;
    }

    const headers = new Headers({
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'application/json'
    });

    let data = {
        vacina: select.value,
        atendimento: idAtendimento
    };

    try {
        let request = await fetch('/vacina/adicionar-aplicacao/' + idAtendimento, {
            method: 'POST',
            headers: headers,
            body: JSON.stringify(data),
            credentials: 'same-origin'
        });

        let response = await request.json();

        if (response.success) {
            window.location.reload();
            return;
        }

        alert(response.message);
    } catch (e) {
        alert(e);
    }
}