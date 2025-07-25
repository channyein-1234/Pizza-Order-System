 $(document).ready(function() {
            $('.btn-plus').click(function() { //event.target == $(this)
                $parentNode = $(this).parents('tr'); // select plus 's specific parent
                $price = Number($parentNode.find('#price').text().replace('$',
                    '')); // find the child's id in that parent and replace the $ with blur in text
                $qty = Number($parentNode.find('#qty').val()); // change to number


                $total = $price * $qty;

                $parentNode.find('#total').html($total + '$');

                summaryCalculation();
            })

            $('.btn-minus').click(function() {
                $parentNode = $(this).parents('tr');
                $price = Number($parentNode.find('#price').text().replace('$', ''));
                $qty = Number($parentNode.find('#qty').val()); // change to number

                $total = $price * $qty;

                $parentNode.find('#total').html($total + '$');
                summaryCalculation();

            })

            $('.BtnRemove').click(function() {
                $parentNode = $(this).parents('tr');
                $parentNode.remove();
                summaryCalculation();
            })


            function summaryCalculation() {
                // total + delivery
                $totalPrice = 0;
                // function take 2 places index and row
                $('#data-table tbody  tr').each(function(index, row) {
                    $totalPrice += Number(($(row).find('#total').text().replace('$', '')));
                })

                $('#subtotal').html($totalPrice + '$'); // can call id directly because it is global element
                $('#finalPrice').html($totalPrice + 3 + '$');

            }
        })
