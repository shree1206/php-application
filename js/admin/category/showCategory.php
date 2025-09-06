<?php
if (!defined('INSIDE_APP')) {
    header("Location: ../");
    exit;
} ?>

<script>

    var tableContainer = document.getElementById('table-container');

    // Initial load
    fetchCategories('categories_name', 'ASC');

    function fetchCategories(sortBy, order) {
        fetch(`/application/ajax/admin/fetch_categories.php?sort_by=${sortBy}&order=${order}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    tableContainer.innerHTML = `<div class="alert alert-danger">${data.error}</div>`;
                    return;
                }

                let tableHtml = `
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="sortable" data-sort="categories_name" data-order="${sortBy === 'categories_name' && order === 'ASC' ? 'DESC' : 'ASC'}">
                                    Category Name
                                    <i class="fas fa-sort-alpha-down-alt"></i>
                                </th>
                                <th scope="col" class="sortable" data-sort="categories_created_at" data-order="${sortBy === 'categories_created_at' && order === 'ASC' ? 'DESC' : 'ASC'}">
                                    Created At
                                    <i class="fas fa-sort-numeric-down-alt"></i>
                                </th>
                                <th scope="col" class="sortable" data-sort="categories_updated_at" data-order="${sortBy === 'categories_updated_at' && order === 'ASC' ? 'DESC' : 'ASC'}">
                                    Updated At
                                    <i class="fas fa-sort-numeric-down-alt"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>`;

                if (data.data.length > 0) {
                    data.data.forEach((category, index) => {
                        tableHtml += `
                            <tr>
                                <th scope="row">${index + 1}</th>
                                <td>${category.categories_name}</td>
                                <td>${category.categories_created_at}</td>
                                <td>${category.categories_updated_at}</td>
                            </tr>`;
                    });
                } else {
                    tableHtml += `<tr><td colspan="4" class="text-center">No categories found.</td></tr>`;
                }

                tableHtml += `</tbody></table>`;
                tableContainer.innerHTML = tableHtml;

                // Add event listeners to the new sortable headers
                document.querySelectorAll('.sortable').forEach(header => {
                    header.addEventListener('click', function () {
                        const newSortBy = this.getAttribute('data-sort');
                        const newOrder = this.getAttribute('data-order');
                        fetchCategories(newSortBy, newOrder);
                    });
                });
            })
            .catch(error => {
                console.error('Error fetching categories:', error);
                tableContainer.innerHTML = `<div class="alert alert-danger">Error loading categories.</div>`;
            });
    }

</script>