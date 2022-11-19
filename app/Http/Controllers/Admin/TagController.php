<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Domain\Information\Queries\TagBuilder;
use App\Http\Requests\Admin\TagRequest;
use Domain\Information\Models\Tag;

class TagController extends Controller
{
    public function index(TagBuilder $builder): Application|Factory|View
    {
        return view('admin.tag.index', [
            'tags' => $builder->getAllTags()
        ]);
    }

    public function create(): Application|Factory|View
    {
        return view('admin.tag.create');
    }

    public function store(TagRequest $request, Tag $tag): RedirectResponse
    {
        $tag->create($request->validated());

        flash()->success('��� ������� ��������');

        return to_route('admin.tags.index');
    }

    public function edit(Tag $tag): Application|Factory|View
    {
        return view('admin.tag.edit', [
            'tag' => $tag
        ]);
    }

    public function update(TagRequest $request, Tag $tag): RedirectResponse
    {
        $tag->update($request->validated());

        flash()->success('��������� ���������');

        return to_route('admin.tags.index');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->articles()->sync([]);

        if (count($tag->articles)) {
            flash()->message('����������, � ���� ���� ������');

            return to_route('admin.tags.index');
        }

        $tag->delete();

        flash()->success('��� ������� �������');

        return to_route('admin.tags.index');
    }
}