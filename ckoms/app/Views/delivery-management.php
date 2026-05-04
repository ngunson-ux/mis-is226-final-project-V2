<!DOCTYPE html>
<html lang="en">
<?= view('header'); ?>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <?= view('navbar'); ?>
    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col d-flex justify-content-center">
                <h1 class="text-capitalize">Delivery Management</h1>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col">
                <div class="row g-3 justify-content-center">
                    <div class="col align-items-stretched" style="width: 20rem;">
                        <div class="card h-100">
                            <div class="card-body text-center">
                            <form action="/delivery-partners" method="get">
                                <button id="deliveryPartners" aria-label="Delivery Partners" class="btn btn-primary" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
                                    <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                    <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492z"/>
                                    </svg>
                                </button>
                                <h5 class="card-title"><label for="deliveryPartners">Delivery Partners</label></h5>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="col align-items-stretched" style="width: 20rem;">
                        <div class="card h-100">
                            <div class="card-body text-center">
                            <form action="/manage-delivery-expense" method="get">
                                <button id="deliveryExpense" aria-label="Delivery Expense" class="btn btn-primary" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16">
                                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                                    <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z"/>
                                    </svg>
                                </button>
                                <h5 class="card-title"><label for="deliveryExpense">Delivery Expense</label></h5>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="col align-items-stretched" style="width: 20rem;">
                        <div class="card h-100">
                            <div class="card-body text-center">
                            <form action="/manage-rider-payment" method="get">
                                <button id="riderPayment" aria-label="Rider Payment" class="btn btn-primary" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                                    <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.5-1.5H2V1.78a1.5 1.5 0 0 1 1.864-1.455zm-10.27.255A.5.5 0 0 0 1.5 1.78V3h13V1.78a.5.5 0 0 0-.636-.479zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
                                    </svg>
                                </button>
                                <h5 class="card-title"><label for="riderPayment">Rider Payment</label></h5>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
