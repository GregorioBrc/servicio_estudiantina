<footer class="bg-white text-center py-6 border-t border-gray-200 shadow-lg">
    <div class="max-w-4xl mx-auto px-4">
        <p class="text-gray-700 font-medium">© {{ date('Y') }} Estudiantina. All rights reserved.</p>
        @if(!empty($content))
            <div class="mt-2 text-sm text-gray-500">
                {{ $content }}
            </div>
        @endif
    </div>
</footer>