<div>
    <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
        <div class="absolute -bottom-16 -left-16 h-40 w-[calc(100%+8rem)]
            bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900">
        </div>
    </div>
    <div class="relative flex items-center gap-6 lg:items-end">
        <div wire:ignore class="flex items-start gap-6 lg:flex-col">
            <div style="width:500px;" id="reader"></div>
            <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
            </div>
            <div class="pt-3 sm:pt-5 lg:pt-0">
                <h2 class="text-xl font-semibold text-black dark:text-white">Documentation</h2>
                <p class="mt-4 text-sm/relaxed">
                    Laravel has wonderful documentation covering every aspect of the framework.
                    Whether you are a newcomer or have prior experience with Laravel, we recommend
                    reading our documentation from beginning to end.
                </p>
            </div>
        </div>
        <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
        </svg>
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
                }
                function onScanFailure(error) {
                    // Handle scan failure, usually better to ignore and keep scanning.
                    // console.warn(`QR code scan error: ${error}`);
                }
                let html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", {fps: 10, qrbox: 250}
                );
                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });
    </script>
@endpush
