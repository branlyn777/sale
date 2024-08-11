<div wire:ignore.self class="modal fade" id="payment_slip" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">
                    Boleta de Pago
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Planilla de pago -->
                <div class="payment-slip">
                    <div class="header">
                        Planilla de Pago
                    </div>
                    <table class="payment-table">
                        <thead>
                            <tr>
                                <th>Placa</th>
                                <th>Tramo</th>
                                <th>Fecha de Carguío</th>
                                <th>Fecha de Descarguío</th>
                                <th>Volumen de Carguío</th>
                                <th>Volumen de Descarguío</th>
                                <th>Diferencia</th>
                                <th>Flete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>5999-SLN</td>
                                <td>Santa Cruz-Ilo</td>
                                <td>04/01/2024</td>
                                <td>08/01/2024</td>
                                <td>28.96</td>
                                <td>28.94</td>
                                <td>0.02</td>
                                <td>598.56</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="summary-table">
                        <tbody>
                            <tr>
                                <td>(+)</td>
                                <td>LIQUIDO A FACTURAR</td>
                                <td class="amount">17,334.00</td>
                            </tr>
                            <tr>
                                <td>(-)</td>
                                <td>Derecho de Empresa 7</td>
                                <td class="amount">1,387.00</td>
                            </tr>
                            <tr>
                                <td>(-)</td>
                                <td></td>
                                <td class="amount">0.00</td>
                            </tr>
                            <tr>
                                <td>(=)</td>
                                <td>TOTAL FLETE A PAGAR - COMISION</td>
                                <td class="amount">15,947.00</td>
                            </tr>
                            <tr>
                                <td>(-)</td>
                                <td>Gastos Operativos</td>
                                <td class="amount">0.00</td>
                            </tr>
                            <tr>
                                <td>(-)</td>
                                <td>ANTICIPOS CANCELADOS</td>
                                <td class="amount">10,000.00</td>
                            </tr>
                            <tr>
                                <td>(=)</td>
                                <td>IMPORTE CANCELADO</td>
                                <td class="amount">5,947.00</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="signature">
                        <div class="received">
                            <p>Recibí Conforme:</p>
                            <div class="line"></div>
                        </div>
                        <div class="ci">
                            <p>CI:</p>
                            <div class="line"></div>
                        </div>
                    </div>
                    <div class="date">
                        Cochabamba 28/03/2024
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>