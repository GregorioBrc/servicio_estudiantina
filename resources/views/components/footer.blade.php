<footer class="bg-gray-100 text-center py-4 mt-8">
    <p>© {{ date('Y') }} Estudiantina. All rights reserved.</p>
    @if(!empty($content))
        <div class="mt-2 text-sm text-gray-600">
            {{ $content }}
        </div>
    @endif
</footer>