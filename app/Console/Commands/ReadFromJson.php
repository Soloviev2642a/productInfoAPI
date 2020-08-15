<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Product;
use App\Category;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Validator;

class ReadFromJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fromJson:read {filePath} {dataType}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $json = json_decode(file_get_contents($this->argument('filePath')), true);

        if ($this->argument('dataType') == 'product') {
            foreach ($json as $line) {
                $validator = Validator::make($line, [
                    'name' => 'required|string|max:200',
                    'description' => 'string|max:1000',
                    'price' => 'required|min:1',
                    'quantity' => 'required',
                    'external_id' => ''
                ]);

                $product = Product::create($validator->validated());
                $product->categories()->attach($line['category_id']);
            }
        }

        if ($this->argument('dataType') == 'category') {
            foreach ($json as $line) {
                $validator = Validator::make($line, [
                    'name' => 'required|string|max:200',
                    'external_id' => ''
                ]);
    
                $category = Category::create($validator->validated());
            }
        }
    }
}
