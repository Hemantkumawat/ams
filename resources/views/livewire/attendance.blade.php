<div>
    <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
        <div class="absolute -bottom-16 -left-16 h-40 w-[calc(100%+8rem)]
            bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900">
        </div>
    </div>
    <div class="relative flex items-center gap-6 lg:items-end">
        <div wire:ignore class="flex items-start gap-6 lg:flex-col">
            <div style="width:500px;" id="reader"></div>

            <div class="pt-3 sm:pt-5 lg:pt-0">
                <h2 class="text-xl font-semibold text-black dark:text-white">Documentation</h2>
                <p class="mt-4 text-sm/relaxed">
                    This application provides an efficient attendance system using a QR Code Scanner.
                    It allows for quick and easy check-ins and check-outs, making attendance tracking a breeze.
                    Whether you are a staff member or a student, you can use this system to mark your attendance with
                    just a scan.
                </p>
            </div>
        </div>

    </div>
</div>
@assets
<script defer src="{{ asset('js/html5-qrcode.min.js') }}" type="text/javascript"></script>
@endassets
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function onScanSuccess(qrMessage) {
            console.log(`qrCodeScanned ${qrMessage}`)
            Livewire.dispatch('qrCodeScanned', [qrMessage]);

            // Disable scanning for 2 seconds
            html5QrcodeScanner.pause();
            setTimeout(() => {
                html5QrcodeScanner.resume();
            }, 2000);

        }

        function onScanFailure(error) {
            // Handle scan failure, usually better to ignore and keep scanning.
            // console.warn(`QR code scan error: ${error}`);
            // Disable scanning for 2 seconds
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {fps: 10, qrbox: 250}
        );
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        /*setTimeout(() => {
            // Modify the reader element
            const readerElement = document.getElementById('reader');
            readerElement.classList.add('p-4', 'border', 'border-gray-300', 'rounded-lg');
            // Modify the dashboard section
            const dashboardSection = document.getElementById('reader__dashboard_section');
            if (dashboardSection) {
                dashboardSection.classList.add('flex', 'justify-between', 'items-center', 'p-4', 'bg-gray-50', 'rounded-lg');
                // Custom buttons
                const buttons = dashboardSection.querySelectorAll('button');
                buttons.forEach(button => {
                    button.classList.add('bg-blue-500', 'text-white', 'py-2', 'px-4', 'rounded-lg', 'hover:bg-blue-600');
                });
            }
        }, 100)*/; // Slight delay to ensure elements are loaded
    });
</script>
@endpush
