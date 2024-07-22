<?php

namespace App\Http\Controllers;

//インポート
use App\Todo;
use App\Http\Requests\TodoRequest;
use Symfony\Component\Console\Input\Input;

class TodoController extends Controller
{
    //プロパティ
    private $todo;

    //コンストラクタ
    public function __construct(Todo $todo)
    {
        //Todoクラスをインスタンス化
        $this->todo = $todo;
    }

    //一覧画面表示
    public function index()
    {
        //todosテーブルの全件取得
        $todos = $this->todo->all();

        //一覧画面を表示・todosテーブルのレコード情報を渡す
        return view('todo.index', ['todos' => $todos]);
    }

    //新規作成画面表示
    public function create()
    {
        //新規作成画面を表示
        return view('todo.create');
    }

    //新規作成
    public function store(TodoRequest $request)
    {
        //Requestのデータを代入
        $inputs = $request->all();
        
        //入力した値を代入
        $this->todo->fill($inputs);
        //DBにデータを保存
        $this->todo->save();
        
        //一覧画面にリダイレクト
        return redirect()->route('todo.index');

    }

    //詳細表示
    public function show($id)
    {
        //選択した値のidを代入
        $todo = $this->todo->find($id);
        //詳細画面を表示
        return view('todo.show', ['todo' => $todo]);
    }

    //編集画面表示
    public function edit($id)
    {
        //idを代入・データを取得
        $todo = $this->todo->find($id);

        //編集画面
        return view('todo.edit' , ['todo' => $todo]);
    }

    //編集機能(更新)
    public function update(TodoRequest $request, $id)
    {
        //入力されたデータを取得
        $inputs = $request->all();
        //更新対象のデータを取得
        $todo = $this->todo->find($id);
        //更新するデータの代入・UPDATE文の実行
        $todo->fill($inputs)->save();

        //編集画面表示
        return redirect()->route('todo.show', $todo->id);
    }
}
