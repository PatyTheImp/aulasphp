function mostraAlunoPorId() 
{
    var id = document.getElementById('slt-id-editar').value;
    var idAlunos = document.getElementsByClassName('idAlunos');
    var nomeAlunos = document.getElementsByClassName('nomeAlunos');
    var anoAlunos = document.getElementsByClassName('anoAlunos');
    var turmaAlunos = document.getElementsByClassName('turmaAlunos');

    var i = 0;
    while (idAlunos[i].innerHTML != id && i < idAlunos.length)
        i++;

    var nome = nomeAlunos[i].innerHTML;
    var ano = anoAlunos[i].innerHTML;
    var turma = turmaAlunos[i].innerHTML;

    document.getElementById('editar-nome-aluno').value = nome;
    document.getElementById('slt-ano-editar').value = ano;
    document.getElementById('slt-turma-editar').value = turma;
}

function mostraDisciplinaPorId()
{
    var id = document.getElementById('slt-id-disciplina-editar').value;
    var idDisciplina = document.getElementsByClassName('idDisciplina');
    var nomeDisciplina = document.getElementsByClassName('nomeDisciplina');
    var professor = document.getElementsByClassName('professor');

    var i = 0;
    while (idDisciplina[i].innerHTML != id && i < idDisciplina.length)
        i++;

    var nome = nomeDisciplina[i].innerHTML;
    var prof = professor[i].innerHTML;

    document.getElementById('editar-nome-disciplina').value = nome;
    document.getElementById('editar-professor').value = prof;
}

function apagarDisciplinaClick() 
{
    document.getElementById('apagar-disciplina-div').style.display = "block";
    document.getElementById('inserir-disciplina-div').style.display = "none";
    document.getElementById('editar-disciplina-div').style.display = "none";
}

function editarDisciplinaClick() 
{
    document.getElementById('apagar-disciplina-div').style.display = "none";
    document.getElementById('inserir-disciplina-div').style.display = "none";
    document.getElementById('editar-disciplina-div').style.display = "block";
}

function inserirDisciplinaClick() 
{
    document.getElementById('apagar-disciplina-div').style.display = "none";
    document.getElementById('inserir-disciplina-div').style.display = "block";
    document.getElementById('editar-disciplina-div').style.display = "none";
}