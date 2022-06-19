<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags & Title -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Home</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/fontawesome-free/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/css/datatables-bs4/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/css/datatables-responsive/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/css/datatables-buttons/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/main/adminlte.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/custom/app.css">
</head>

<body class="container-fluid" onload="initialyze()">
    <div class="wrapper">
        <!-- Main content -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                                <h2>Lista de Tarefas</h2>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="tasks-table" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Título</th>
                                            <th>Descrição</th>
                                            <th>Prazo de Entrega</th>
                                            <th>Operações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- To Be filled by AJAX script -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Título</th>
                                            <th>Descrição</th>
                                            <th>Prazo de Entrega</th>
                                            <th>Operações</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h2>Adicionar Tarefa</h2>
                            </div>
                            <!-- /.card-header -->
                            <!-- ADD NEW TASK Section -->
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Título:</strong>
                                                <input type="text" name="title" id="titleInput" class="form-control" placeholder="Ex.: Estudar ReactJS">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Descrição da tarefa:</strong>
                                                <input type="text" name="description" id="descriptionInput" class="form-control" placeholder="Ex.: Estudar a biblioteca JavaScript React">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Prazo de entrega:</strong>
                                                <input type="datetime-local" name="deadline" id="deadlineInput" class="form-control" placeholder="">
                                            </div>
                                            <button class="btn btn-primary mt-3" onclick="saveTasks()">Salvar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- End of ADD NEW TASK Section -->
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="modal fade" id="editionModal" tabindex="-1" role="dialog" aria-labelledby="editionModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editionModalLabel">Editar Tarefa</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <input type="hidden" id="task-id">
                                                <label for="task-title" class="col-form-label">Título:</label>
                                                <input type="text" class="form-control" id="task-title">
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" id="task-id">
                                                <label for="task-description" class="col-form-label">Descrição:</label>
                                                <input type="text" class="form-control" id="task-description">
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" id="task-id">
                                                <label for="task-deadline" class="col-form-label">Prazo de Entrega:</label>
                                                <input type="text" class="form-control" id="task-deadline" onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="edit()">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="/js/jquery/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap 4 -->
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="/js/datatables/jquery.dataTables.min.js"></script>
    <script src="/js/datatables-bs4/dataTables.bootstrap4.min.js"></script>
    <script src="/js/datatables-responsive/dataTables.responsive.min.js"></script>
    <script src="/js/datatables-responsive/responsive.bootstrap4.min.js"></script>
    <script src="/js/datatables-buttons/dataTables.buttons.min.js"></script>
    <script src="/js/datatables-buttons/buttons.bootstrap4.min.js"></script>
    <script src="/js/datatables-buttons/buttons.html5.min.js"></script>
    <script src="/js/datatables-buttons/buttons.print.min.js"></script>
    <script src="/js/datatables-buttons/buttons.colVis.min.js"></script>
    <script src="/js/jszip/jszip.min.js"></script>
    <script src="/js/pdfmake/pdfmake.min.js"></script>
    <script src="/js/pdfmake/vfs_fonts.js"></script>
    <!-- AdminLTE App -->
    <script src="/js/main/adminlte.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#tasks-table").DataTable({
                "searching": false,
                "paging": false,
                "info": false,
                "ordering": false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                lengthMenu: [5, 10],
                "language": {

                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ à _END_ de um total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "Mostrando _MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar na Lista:",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }

                }

            }).buttons().container().appendTo('#tasks-table_wrapper .col-md-6:eq(0)');

        });
    </script>

    <script type="text/javascript">
        function initialyze() {
            getTasks();
        }

        function getTasks() {
            $.ajax({
                type: "GET",
                url: "/todolist",
                success: function(data) {
                    console.log(data);
                    if (data.length > 0) {
                        const table = document.getElementsByTagName('tbody')[0];
                        table.innerHTML = "";
                        for (var i = 0; i < data.length; i++) {
                            try {
                                const row = table.insertRow(i);
                                const cell1 = row.insertCell(0);
                                const cell2 = row.insertCell(1);
                                const cell3 = row.insertCell(2);
                                const cell4 = row.insertCell(3);
                                const cell5 = row.insertCell(4);
                                cell1.innerHTML = data[i].id;
                                cell2.innerHTML = data[i].title;
                                cell3.innerHTML = data[i].description;
                                cell4.innerHTML = data[i].deadline;
                                cell5.innerHTML = `<button class="btn btn-primary" onclick="openEditModal(${data[i].id},'${data[i].title}','${data[i].description}','${data[i].deadline}')"><i class="fa fa-edit"></i></button>
                                                   <button class="btn btn-danger" onclick="deleteTask(${data[i].id})"><i class="fa fa-trash"></i></button>`;
                            } catch (error) {
                                console.log(error);
                            }
                        }
                    } else {
                        var row = table.insertRow(0);
                        var cell = row.insertCell(0);
                        cell.innerHTML = 'No tasks';
                    }
                },
                error: function(error) {
                    alert(`Error ${error}`);
                }
            })
        }

        function saveTasks() {
            const title = document.getElementById('titleInput').value;
            const description = document.getElementById('descriptionInput').value;
            const deadline = document.getElementById('deadlineInput').value;
            $.ajax({
                type: "POST",
                url: "/todolist",
                data: {
                    title: title,
                    description: description,
                    deadline: deadline
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data);
                    getTasks();
                },
                error: function(error) {
                    alert(`Error ${error}`);
                }
            })
            document.getElementById('titleInput').value = "";
            document.getElementById('descriptionInput').value = "";
            document.getElementById('deadlineInput').value = "";
        }

        function deleteTask(id) {
            $.ajax({
                type: "DELETE",
                url: `/todolist/${id}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data);
                    getTasks();
                },
                error: function(error) {
                    alert(`Error ${error}`);
                }
            })
        }

        function openEditModal(id, title, description, deadline) {
            $('#editionModal').modal('show');
            $('#task-id').val(id);
            $('#task-title').val(title);
            $('#task-description').val(description);
            $('#task-deadline').val(deadline);
        }

        function edit() {
            var id = $('#task-id').val();
            var title = $('#task-title').val();
            var description = $('#task-description').val();
            var deadline = $('#task-deadline').val();
            $.ajax({
                type: "PUT",
                url: `/todolist/${id}`,
                data: {
                    title: title,
                    description: description,
                    deadline: deadline
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data);
                    getTasks();
                },
                error: function(error) {
                    alert(`Error ${error}`);
                }
            })
        }
    </script>
</body>

</html>