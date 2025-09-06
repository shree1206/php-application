<?php
if (!defined('INSIDE_APP')) {
    header("Location: ../");
    exit;
} ?>

<script>
    var tableContainer = document.getElementById('table-container');
    var currentPage = 1;
    var currentSortBy = 'categories_name';
    var currentOrder = 'ASC';

    fetchCategories(currentSortBy, currentOrder, currentPage);

    function fetchCategories(sortBy, order, page) {
        currentSortBy = sortBy;
        currentOrder = order;
        currentPage = page;

        fetch(`/application/ajax/admin/fetch_categories.php?sort_by=${sortBy}&order=${order}&page=${page}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    tableContainer.innerHTML = `<div class="alert alert-danger">${data.error}</div>`;
                    return;
                }

                var tableHtml = `
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="sortable" data-sort="categories_name" data-order="${sortBy === 'categories_name' && order === 'ASC' ? 'DESC' : 'ASC'}">
                                    Category Name
                                    <i class="fa fa-sort"></i>
                                </th>
                                <th scope="col" class="sortable" data-sort="categories_created_at" data-order="${sortBy === 'categories_created_at' && order === 'ASC' ? 'DESC' : 'ASC'}">
                                    Created At
                                    <i class="fa fa-sort"></i>
                                </th>
                                <th scope="col" class="sortable" data-sort="categories_updated_at" data-order="${sortBy === 'categories_updated_at' && order === 'ASC' ? 'DESC' : 'ASC'}">
                                    Updated At
                                    <i class="fa fa-sort"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>`;

                if (data.data.length > 0) {
                    data.data.forEach((category, index) => {
                        tableHtml += `
                            <tr>
                                <th scope="row">${(data.current_page - 1) * 10 + index + 1}</th>
                                <td>${category.categories_name}</td>
                                <td>${category.categories_created_at}</td>
                                <td>${category.categories_updated_at}</td>
                            </tr>`;
                    });
                } else {
                    tableHtml += `<tr><td colspan="4" class="text-center">No categories found.</td></tr>`;
                }

                tableHtml += `</tbody></table>`;
                tableHtml += renderPagination(data.total_pages, data.current_page); // Add pagination links
                tableContainer.innerHTML = tableHtml;

                // Add event listeners to the new sortable headers
                document.querySelectorAll('.sortable').forEach(header => {
                    header.addEventListener('click', function () {
                        var newSortBy = this.getAttribute('data-sort');
                        var newOrder = this.getAttribute('data-order');
                        fetchCategories(newSortBy, newOrder, 1); // Reset to page 1 on sort
                    });
                });

                // Add event listeners to pagination links
                document.querySelectorAll('.page-link').forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        var newPage = parseInt(this.getAttribute('data-page'));
                        if (newPage) {
                            fetchCategories(currentSortBy, currentOrder, newPage);
                        }
                    });
                });
            })
            .catch(error => {
                console.error('Error fetching categories:', error);
                tableContainer.innerHTML = `<div class="alert alert-danger">Error loading categories.</div>`;
            });
    }

    function renderPagination(totalPages, currentPage) {
        var paginationHtml = `<nav><ul class="pagination justify-content-center">`;

        // Previous button
        paginationHtml += `<li class="page-item ${currentPage <= 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="${currentPage - 1}">Previous</a>
        </li>`;

        // Page links
        for (var i = 1; i <= totalPages; i++) {
            paginationHtml += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="#" data-page="${i}">${i}</a>
            </li>`;
        }

        // Next button
        paginationHtml += `<li class="page-item ${currentPage >= totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="${currentPage + 1}">Next</a>
        </li>`;

        paginationHtml += `</ul></nav>`;
        return paginationHtml;
    }

</script>