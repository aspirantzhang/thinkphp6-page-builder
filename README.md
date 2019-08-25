ThinkPHP AntDesign Builder
---

A api page builder for AntDesign base on ThinkPHP 6

Under development, **DO NOT** apply to production environments !!!

>This package expected to return array or json format for page structure.
>So it **MUST BE** used in conjunction with the **SPECIFIC** AntDesignPro package (Not published yet).
>Or you can reference the return code to develop your own frontend package.

### Quick start

```
$builder
->toContainer($name)->addElements($name,$title)->attributes($content)
->build()
```

### Installation

#### Step 1
```
composer require aspirantzhang/thinkphp-antdesign-builder
```
#### Step 2
Edit `app\provider.php`, insert below code
```
'think\Paginator' => 'aspirantzhang\TPAntdBuilder\AntdPaginationProvider'
```
### Usage

Example code for build page elements.
```
use aspirantzhang\TPAntdBuilder\Builder;

class Admin extends Common
{
    // Page Builder
    public function buildPageIndex()
    {
        $builder = new Builder;

        $builder->page('admin-list', 'Admin List')
                ->pageType('list')
                ->table('tablename' ,'Table Title');

        $builder->searchBar()
                ->addText('username', 'Admin Name')
                ->placeholder('Enter Admin Name');
        $builder->searchBar()
                ->addSelect('status', 'Status')
                ->placeholder('Select Status')
                ->option([
                    'Disable'   =>  0,
                    'Enable'    =>  1,
                ]);


        $builder->toTable('tablename')
                ->addColumn('id', 'ID');
        $builder->toTable('tablename')
                ->addColumn('name', 'Admin Name')
                ->link('#/backend/admins/edit');
        $builder->toTable('tablename')
                ->addColumn('action', 'Operation')
                ->actionButton('edit', 'Edit', [
                    'onClick'   =>  [
                        'name'  =>  'openModal',
                        'url'   =>  'backend/admins/edit'
                    ]
                ])
                ->actionButton('delete', 'Delete', [
                    'onConfirm'   =>  [
                        'name'  =>  'changeStatus',
                        'url'   =>  'backend/admins/delete'
                    ]
                ]);

        return $builder->build();
    }
}
```
Use thinkphp build-in pagination method to get list data.
And then, mix them like this:
```
public function listApi($data)
{
    $list = $this->buildPageIndex();
    $dataSource = $this->where('status', 1)->paginate(10);
    $list['table']['dataSource'] = $dataSource['dataSource'];
    $list['table']['pagination'] = $dataSource['pagination'];
    return $list;
}
```
So we get the returned code below, they woud be called by AntDesignPro frontend.
```
{
    "page":
    {
        "name": "admin-list",
        "title": "Admin List",
        "pageType": "list"
    },
    "table":
    {
        "name": "tablename",
        "title": "Table Title",
        "column": [
        {
            "dataIndex": "id",
            "title": "ID"
        },
        {
            "dataIndex": "name",
            "title": "Admin Name",
            "a":
            {
                "href": "#\/backend\/admins\/edit",
                "target": "_self"
            }
        },
        {
            "dataIndex": "action",
            "title": "Operation",
            "action": [
            {
                "dataIndex": "edit",
                "title": "Edit",
                "onClick":
                {
                    "name": "openModal",
                    "url": "backend\/admins\/edit"
                }
            },
            {
                "dataIndex": "delete",
                "title": "Delete",
                "onConfirm":
                {
                    "name": "changeStatus",
                    "url": "backend\/admins\/delete"
                }
            }]
        }],
        "dataSource": [
        {
            "id": 69,
            "username": "admin2211",
            "display_name": "admin2211",
            "create_time": "2019-08-20 15:24:57",
            "update_time": "2019-08-20 15:24:57",
            "status": 1
        },
        {
            "id": 54,
            "username": "test152",
            "display_name": "test152",
            "create_time": "2019-08-15 23:29:00",
            "update_time": "2019-08-15 23:29:00",
            "status": 1
        },
        {
            "id": 48,
            "username": "fix0001",
            "display_name": "fix0001",
            "create_time": "2019-08-15 13:53:21",
            "update_time": "2019-08-15 13:53:21",
            "status": 1
        }],
        "pagination":
        {
            "total": 37,
            "pageSize": 10,
            "current": 1
        }
    },
    "searchBar": [
    {
        "component": "input",
        "name": "username",
        "title": "Admin Name",
        "placeholder": "Enter Admin Name"
    },
    {
        "component": "select",
        "name": "status",
        "title": "Status",
        "placeholder": "Select Status",
        "option":
        {
            "Disable": 0,
            "Enable": 1
        }
    }]
}
```
### Change Log



